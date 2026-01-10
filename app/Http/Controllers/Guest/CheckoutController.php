<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemStock;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\TransactionLog;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CheckoutController extends Controller
{
    public function checkout(Request $request, Product $product)
    {
        \Log::info("CHECKOUT MASUK", $request->all());

        $request->validate([
            'item_id'  => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = Item::withCount('stocks')->findOrFail($request->item_id);
        $user = Auth::user();
        $qty  = (int) $request->quantity;

        if ($item->stocks_count < $qty) {
            return back()->with('error', 'Stok tidak cukup.');
        }

        // required fields product
        $customerInputs = [];
        foreach ($product->required_fields ?? [] as $field) {
            $customerInputs[$field] = $request->input($field);
        }

        $unitPrice = ($user->role === 'admin' || $user->role === 'reseller')
            ? $item->price_reseller
            : $item->price_guest;

        $total = $unitPrice * $qty;

        if ($user->saldo < $total) {
            return back()->with('error', 'Saldo tidak cukup.');
        }

        $delivered = [];
        $tx = null;
        $txItem = null;

        DB::transaction(function () use (
            $user, $product, $item, $qty, $unitPrice, $total, $customerInputs,
            &$delivered, &$tx, &$txItem
        ) {
            // Update saldo dan last_order_at
            $user->saldo -= $total;
            $user->last_order_at = now();
            $user->save();

            $stocks = ItemStock::where('item_id', $item->id)
                ->orderBy('id')
                ->limit($qty)
                ->get();

            foreach ($stocks as $s) {
                $data = $s->data;
                $delivered[] = is_array($data) ? implode("\n", $data) : $data;
            }

            ItemStock::whereIn('id', $stocks->pluck('id'))->delete();

            $tx = Transaction::create([
                'user_id'          => $user->id,
                'total_amount'     => $total,
                'role_at_purchase' => $user->role,
                'customer_inputs'  => json_encode($customerInputs),
            ]);

            $txItem = TransactionItem::create([
                'transaction_id' => $tx->id,
                'item_id'        => $item->id,
                'unit_price'     => $unitPrice,
                'quantity'       => $qty,
                'delivered_data' => json_encode($delivered),
            ]);

            TransactionLog::create([
                'user_id'        => $user->id,
                'transaction_id' => $tx->id,
                'description'    => "Pembelian {$qty}x {$item->name}",
                'amount'         => -$total,
            ]);

            // ✅ UPDATE POINT USER BULAN INI
            $currentMonth = now()->month;
            $currentYear = now()->year;

            $point = Point::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'month' => $currentMonth,
                    'year' => $currentYear,
                ],
                [
                    'total_items' => 0,
                    'points' => 0,
                ]
            );

            // Tambah jumlah item yang dibeli
            $point->total_items += $qty;
            $point->points = $point->total_items;
            $point->save();
        });

        // ==========================
        // ✅ KIRIM TELEGRAM (PAKAI CONFIG, BUKAN env())
        // ==========================
        try {
            $token   = config('services.telegram.bot_token');
            $gcAdmin = config('services.telegram.gc_admin');
            $gcLogs  = config('services.telegram.gc_logs');

            \Log::info("TELEGRAM CONFIG CHECK", [
                'has_token' => !empty($token),
                'gc_admin'  => $gcAdmin,
                'gc_logs'   => $gcLogs,
            ]);

            if ($token) {
                $itemsName = $item->name;
                $qtyText   = $qty;

                $dataInputsText = $this->formatCustomerInputs($customerInputs);
                
                // Format username Telegram dengan @ jika ada
                $teleUsername = '';
                if (!empty($user->nama_tele)) {
                    // Hapus @ di depan jika sudah ada
                    $cleanTele = ltrim($user->nama_tele, '@');
                    $teleUsername = "https://t.me/{$cleanTele}";
                }

                $captionAdmin =
                    "TOR MONITORR ADMIN\n\n" .
                    "NAMA ITEMS: {$itemsName}\n" .
                    "JUMLAH YANG DI BELI: {$qtyText}\n\n" .
                    "DATA YANG DI ISI:\n{$dataInputsText}\n\n" .
                    "NAMA AKUN: {$user->name}\n" .
                    "NOMER WHATSAPP: {$user->whatsapp}\n" .
                    "TELEGRAM: [@{$user->nama_tele}]({$teleUsername})";

                // 1) GC ADMIN (photo thumbnail kalau ada, fallback tq.webp)
                if ($gcAdmin) {
                    if (!empty($product->thumbnail) && Storage::disk('public')->exists($product->thumbnail)) {
                        $this->sendTelegramPhotoFromStorage($token, $gcAdmin, $captionAdmin, $product->thumbnail);
                    } else {
                        $this->sendTelegramPhotoFromPublic($token, $gcAdmin, $captionAdmin, public_path('images/tq.webp'));
                    }
                }

                // 2) GC LOGS UMUM
                if ($gcLogs) {
                    $captionLogs =
                        "WOW TERIMAKASIH {$user->name} TELAH MEMBELI {$itemsName}. SEBANYAK {$qtyText}\n" .
                        "JANGAN LUPA ORDER LAGII YAWWWW ❤️💕";

                    $this->sendTelegramPhotoFromPublic($token, $gcLogs, $captionLogs, public_path('images/tq.webp'));
                }
            } else {
                \Log::warning("TELEGRAM TOKEN kosong dari config('services.telegram.bot_token')");
            }
        } catch (\Throwable $e) {
            \Log::error("TELEGRAM SEND ERROR: " . $e->getMessage());
        }

        return view('guest.checkout_done', [
            'product'        => $product,
            'item'           => $item,
            'quantity'       => $qty,
            'total'          => $total,
            'delivered'      => $delivered,
            'customerInputs' => $customerInputs,
        ]);
    }

    private function formatCustomerInputs(array $inputs): string
    {
        if (empty($inputs)) return "-";

        $lines = [];
        foreach ($inputs as $k => $v) {
            $key = strtoupper(str_replace('_', ' ', $k));
            $val = (string) $v;
            $lines[] = "- {$key}: {$val}";
        }
        return implode("\n", $lines);
    }

    // ✅ token dikirim lewat parameter (bukan env())
    private function sendTelegramPhotoFromStorage(string $token, string $chatId, string $caption, string $storagePath): void
    {
        if (!Storage::disk('public')->exists($storagePath)) {
            \Log::warning("STORAGE IMAGE NOT FOUND: {$storagePath}");
            return;
        }

        $fileBinary = Storage::disk('public')->get($storagePath);

        $res = Http::attach('photo', $fileBinary, basename($storagePath))
            ->post("https://api.telegram.org/bot{$token}/sendPhoto", [
                'chat_id' => $chatId,
                'caption' => $caption,
                'parse_mode' => 'Markdown', // Ditambahkan untuk format Markdown
            ]);

        \Log::info("TELEGRAM ADMIN RESP", ['ok' => $res->ok(), 'body' => $res->body()]);
    }

    // ✅ token dikirim lewat parameter (bukan env())
    private function sendTelegramPhotoFromPublic(string $token, string $chatId, string $caption, string $publicFilePath): void
    {
        if (!file_exists($publicFilePath)) {
            \Log::warning("PUBLIC IMAGE NOT FOUND: {$publicFilePath}");
            return;
        }

        $fileBinary = file_get_contents($publicFilePath);

        $res = Http::attach('photo', $fileBinary, basename($publicFilePath))
            ->post("https://api.telegram.org/bot{$token}/sendPhoto", [
                'chat_id' => $chatId,
                'caption' => $caption,
                'parse_mode' => 'Markdown', // Ditambahkan untuk format Markdown
            ]);

        \Log::info("TELEGRAM LOGS RESP", ['ok' => $res->ok(), 'body' => $res->body()]);
    }
}