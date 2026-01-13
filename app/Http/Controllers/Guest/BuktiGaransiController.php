<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\TransactionItem;
use App\Models\BuktiLogin;
use App\Models\ClaimGaransi;

class BuktiGaransiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $transactionItems = TransactionItem::whereHas('transaction', fn ($q) =>
                $q->where('user_id', $user->id)
            )
            ->validForBuktiLogin()
            ->whereDoesntHave('buktiLogins')
            ->with('item')
            ->latest()
            ->get();

        $itemsForGaransi = BuktiLogin::where('user_id', $user->id)
            ->validForGaransi()
            ->whereDoesntHave('claimGaransi')
            ->with('transactionItem.item')
            ->latest()
            ->get();

        return view('guest.bukti-garansi', compact(
            'transactionItems',
            'itemsForGaransi'
        ));
    }

    /* =========================
       STORE BUKTI LOGIN
    ========================= */
    public function storeBuktiLogin(Request $request)
    {
        $request->validate([
            'transaction_item_id' => 'required|exists:transaction_items,id',
            'email_akun' => 'required|email',
            'nama_buyer' => 'required|string',
            'tipe_akun' => 'required|in:private,sharing',
            'durasi' => 'required|string',
            'device' => 'required|string',
            'lokasi' => 'required|string',
            'penggunaan' => 'required|in:pribadi,cust',
            'image' => 'required|image|max:2048',
        ]);

        $user = auth()->user();

        $item = TransactionItem::where('id', $request->transaction_item_id)
            ->whereHas('transaction', fn ($q) => $q->where('user_id', $user->id))
            ->whereDoesntHave('buktiLogins')
            ->firstOrFail();

        if (! $item->isStillValid24Hours()) {
            return back()->withErrors('Batas waktu upload bukti login sudah lewat 24 jam.');
        }

        $path = $request->file('image')->store('bukti-login', 'public');

        $bukti = BuktiLogin::create([
            'user_id' => $user->id,
            'transaction_item_id' => $item->id,
            'item_id' => $item->item_id,
            'email_akun' => $request->email_akun,
            'nama_buyer' => $request->nama_buyer,
            'tipe_akun' => $request->tipe_akun,
            'durasi' => $request->durasi,
            'device' => $request->device,
            'lokasi' => $request->lokasi,
            'penggunaan' => $request->penggunaan,
            'image_path' => $path,
        ]);

        $tanggal = Carbon::now()->translatedFormat('d F Y');
        $teleLink = $user->nama_tele ? "https://t.me/" . ltrim($user->nama_tele, '@') : '-';

        $this->sendTelegram(
            env('TELEGRAM_GC_BUKTI_LOGIN'),
            "📌 *BUKTI LOGIN*\n"
            ."━━━━━━━━━━━━━━━━━━━\n\n"
            ."📦 *Detail Akun*\n"
            ."• *Item*       : {$item->item->name}\n"
            ."• *Email*      : {$bukti->email_akun}\n"
            ."• *Nama Buyer* : {$bukti->nama_buyer}\n"
            ."• *Tipe Akun*  : {$bukti->tipe_akun}\n"
            ."• *Durasi*     : {$bukti->durasi}\n\n"
            ."📱 *Penggunaan*\n"
            ."• *Device*     : {$bukti->device}\n"
            ."• *Lokasi*     : {$bukti->lokasi}\n"
            ."• *Mode*       : {$bukti->penggunaan}\n"
            ."• *Tanggal*    : {$tanggal}\n\n"
            ."👤 *Pelapor*\n"
            ."• *Nama* : {$user->name}\n"
            ."• *Telegram* : ".($user->nama_tele ? "[@{$user->nama_tele}]($teleLink)" : "-")."\n"
            ."• *WhatsApp* : {$user->whatsapp}",
            $path
        );

        return back()->with('success', 'Bukti login berhasil dikirim.');
    }

    /* =========================
       STORE GARANSI
    ========================= */
    public function storeGaransi(Request $request)
    {
        $request->validate([
            'bukti_login_id' => 'required|exists:bukti_logins,id',
            'sisa_durasi' => 'required|string',
            'email_akun' => 'required|email',
            'password_akun' => 'required|string',
            'device' => 'required|string',
            'lokasi' => 'required|string',
            'penggunaan' => 'required|in:pribadi,cust',
            'permasalahan' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $user = auth()->user();

        $bukti = BuktiLogin::where('id', $request->bukti_login_id)
            ->where('user_id', $user->id)
            ->with('transactionItem.item')
            ->firstOrFail();

        if ($bukti->claimGaransi) {
            return back()->withErrors('Item ini sudah pernah diklaim.');
        }

        if (! $bukti->isStillValid30Days()) {
            return back()->withErrors('Masa klaim garansi sudah berakhir.');
        }

        $path = $request->file('image')->store('klaim-garansi', 'public');

        $garansi = ClaimGaransi::create([
            'user_id' => $user->id,
            'bukti_login_id' => $bukti->id,
            'transaction_item_id' => $bukti->transaction_item_id,
            'tanggal_order' => $bukti->transactionItem->created_at->toDateString(),
            'tanggal_bermasalah' => now()->toDateString(),
            'sisa_durasi' => $request->sisa_durasi,
            'email_akun' => $request->email_akun,
            'password_akun' => $request->password_akun,
            'device' => $request->device,
            'lokasi' => $request->lokasi,
            'penggunaan' => $request->penggunaan,
            'permasalahan' => $request->permasalahan,
            'image_path' => $path,
        ]);

        $teleLink = $user->nama_tele ? "https://t.me/" . ltrim($user->nama_tele, '@') : '-';

        $this->sendTelegram(
            env('TELEGRAM_GC_GARANSI'),
            "🚨 *KLAIM GARANSI*\n"
            ."━━━━━━━━━━━━━━━━━━━\n\n"
            ."📦 *Item* : {$bukti->transactionItem->item->name}\n"
            ."• *Sisa Durasi* : {$garansi->sisa_durasi}\n\n"
            ."🛠 *Permasalahan*\n```{$garansi->permasalahan}```\n\n"
            ."👤 *Pelapor*\n"
            ."• *Nama* : {$user->name}\n"
            ."• *Telegram* : ".($user->nama_tele ? "[@{$user->nama_tele}]($teleLink)" : "-")."\n"
            ."• *WhatsApp* : {$user->whatsapp}",
            $path
        );

        return back()->with('success', 'Klaim garansi berhasil dikirim.');
    }

    private function sendTelegram(string $chatId, string $caption, string $imagePath): void
    {
        try {
            $response = Http::attach(
                'photo',
                Storage::disk('public')->get($imagePath),
                basename($imagePath)
            )->post("https://api.telegram.org/bot".env('TELEGRAM_BOT_TOKEN')."/sendPhoto", [
                'chat_id' => $chatId,
                'caption' => $caption,
                'parse_mode' => 'Markdown',
            ]);

            if (! $response->successful()) {
                logger()->error('Telegram API Error', $response->json());
            }
        } catch (\Throwable $e) {
            logger()->error('Telegram Exception', ['error' => $e->getMessage()]);
        }
    }
}
