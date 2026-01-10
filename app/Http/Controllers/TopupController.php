<?php

namespace App\Http\Controllers;

use App\Models\TopupTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TopupController extends Controller
{
    private string $base = "https://cashify.my.id/api/generate";
    private string $license;
    private string $qrisId;

    public function __construct()
    {
        $this->license = env('CASHIFY_LICENSE');
        $this->qrisId  = env('CASHIFY_QRIS_ID');
    }

    private function generateQRCodeUrl(string $qrString): string
    {
        return "https://larabert-qrgen.hf.space/v1/create-qr-code?" . http_build_query([
            'size'  => '500x500',
            'style' => '1',
            'color' => 'ffc0cb',
            'data'  => $qrString,
        ]);
    }

    /* =========================
       CREATE TOPUP
    ========================= */
    public function createTopup(Request $request)
    {
        $amount = (int) ($request->amount ?? $request->custom_amount);

        if (!$amount || $amount < 5000) {
            return back()->with('error', 'Minimal top up Rp 5.000');
        }

        $unique = rand(90, 150);
        $total  = $amount + $unique;

        $response = Http::withHeaders([
            'x-license-key' => $this->license,
        ])->post("$this->base/qris", [
            "id" => $this->qrisId,
            "amount" => $total,
            "useUniqueCode" => true,
            "packageIds" => [
                "com.orderkuota.app"
            ],
            "expiredInMinutes" => 15,
        ]);

        $json = $response->json();

        if (!$response->successful() || !isset($json['data'])) {
            return back()->with('error', 'Gagal generate QRIS');
        }

        $data = $json['data'];

        $trx = TopupTransaction::create([
            'user_id'         => Auth::id(),
            'transaction_id'  => $data['transactionId'],
            'amount'          => $amount,
            'unique_code'     => $unique,
            'total_amount'    => $total,
            'qr_string'       => $data['qr_string'],
            'qr_url'          => $this->generateQRCodeUrl($data['qr_string']),
            'expired_at'      => now()->addMinutes(15),
            'status'          => 'pending',
        ]);

        return redirect()->route('topup.payment', $trx->id);
    }

    /* =========================
       SHOW PAYMENT
    ========================= */
    public function showPayment($id)
    {
        $trx = TopupTransaction::with('user')->findOrFail($id);

        // kalau bukan milik user yang login, block
        if ($trx->user_id !== Auth::id()) {
            abort(403);
        }

        // kalau sudah paid/cancel/expired atau sudah lewat expired_at -> redirect
        if ($trx->status !== 'pending' || now()->greaterThan($trx->expired_at)) {
            return redirect()->route('guest.home');
        }

        return view('topup.payment', compact('trx'));
    }

    /* =========================
       CHECK STATUS (AJAX)
       ✅ SAFE: anti double increment (DB lock + transaction)
    ========================= */
    public function checkStatus($id)
    {
        $trx = TopupTransaction::with('user')->findOrFail($id);

        // security: pastikan user yg login adalah pemilik trx
        if ($trx->user_id !== Auth::id()) {
            return response()->json(['status' => 'forbidden'], 403);
        }

        // kalau sudah final, langsung return (hemat request & aman)
        if (in_array($trx->status, ['paid', 'cancel', 'expired'], true)) {
            return response()->json(['status' => $trx->status]);
        }

        // EXPIRED by time (server-side)
        if (now()->greaterThan($trx->expired_at)) {
            // set expired sekali (idempotent)
            if ($trx->status === 'pending') {
                $trx->update(['status' => 'expired']);
            }
            return response()->json(['status' => 'expired']);
        }

        // hit provider check
        $check = Http::withHeaders([
            'x-license-key' => $this->license,
        ])->post("$this->base/check-status", [
            'transactionId' => $trx->transaction_id,
        ]);

        $providerStatus = strtolower($check->json('data.status', 'pending'));

        // kalau provider belum paid, return status db (pending)
        if ($providerStatus !== 'paid') {
            return response()->json(['status' => $trx->status]);
        }

        // ✅ PROVIDER PAID => lakukan proses kredit saldo 1x (ATOMIC)
        DB::transaction(function () use ($trx) {

            // lock row transaksi
            $lockedTrx = TopupTransaction::where('id', $trx->id)
                ->lockForUpdate()
                ->first();

            // kalau sudah diproses oleh request lain, stop
            if (!$lockedTrx || $lockedTrx->status === 'paid') {
                return;
            }
            if ($lockedTrx->status !== 'pending') {
                // kalau cancel/expired, jangan proses
                return;
            }

            // lock user biar saldo before/after akurat
            $user = User::where('id', $lockedTrx->user_id)
                ->lockForUpdate()
                ->first();

            if (!$user) return;

            $saldoSebelum = (int) $user->saldo;

            // update trx dulu, supaya idempotent
            $lockedTrx->status  = 'paid';
            $lockedTrx->paid_at = now();
            $lockedTrx->save();

            // kredit saldo (bisa pakai increment juga, tapi pakai save biar satu lock)
            $user->saldo = $saldoSebelum + (int) $lockedTrx->amount;
            $user->save();

            $saldoSesudah = (int) $user->saldo;

            // telegram notif cuma sekali karena trx sudah paid di dalam lock
            $this->sendTelegramMessage(
                env('TELEGRAM_GC_DEPOSIT'),
                "🔔 *Pembayaran Berhasil!*\n\n"
                ."*Detail Transaksi:*\n"
                ."• ID: `{$lockedTrx->transaction_id}`\n"
                ."• Jumlah: Rp ".number_format($lockedTrx->total_amount, 0, ',', '.')."\n"
                ."• Status: *PAID*\n"
                ."• Waktu: ".now()->format('d/m/Y, H.i.s')."\n"
                ."• Perangkat: {$lockedTrx->transaction_id}\n"
                ."• Nama user: {$user->name}\n"
                ."• Saldo: Rp ".number_format($saldoSebelum, 0, ',', '.')
                ." ➜ Rp ".number_format($saldoSesudah, 0, ',', '.')
            );
        });

        // re-fetch status terbaru
        $fresh = TopupTransaction::find($id);

        return response()->json([
            'status' => $fresh?->status ?? 'pending'
        ]);
    }

    /* =========================
       CANCEL PAYMENT
       ✅ recommended pakai POST route (lihat bagian route/view)
    ========================= */
    public function cancelPayment($id)
    {
        $trx = TopupTransaction::findOrFail($id);

        if ($trx->user_id !== Auth::id()) {
            abort(403);
        }

        // kalau sudah final, langsung pulang
        if (in_array($trx->status, ['paid', 'cancel', 'expired'], true)) {
            return redirect()->route('guest.home');
        }

        // cancel provider (best effort)
        Http::withHeaders([
            'x-license-key' => $this->license,
        ])->post("$this->base/cancel-status", [
            'transactionId' => $trx->transaction_id,
        ]);

        $trx->update(['status' => 'cancel']);

        return redirect()->route('guest.home');
    }

    /* =========================
       TELEGRAM MESSAGE
    ========================= */
    private function sendTelegramMessage(string $chatId, string $message)
    {
        // best effort - jangan sampai error telegram ngerusak transaksi
        try {
            Http::post("https://api.telegram.org/bot".env('TELEGRAM_BOT_TOKEN')."/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);
        } catch (\Throwable $e) {
            // optional: log error
            // \Log::error($e->getMessage());
        }
    }
}
