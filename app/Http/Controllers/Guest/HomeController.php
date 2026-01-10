<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $selectedSlug = $request->get('category', 'all');

        // urutan kategori = kategori pertama, kedua, dst (sesuai orderBy)
        $categories = Category::orderBy('name')->get();

        $last7 = now()->subDays(7);

        /*
        |--------------------------------------------------------------------------
        | BASE QUERY PRODUCT (sekalian hitung sold_7_days biar blade ringan)
        |--------------------------------------------------------------------------
        */
        $productQuery = Product::query()
            ->with([
                'category',
                'items.stocks',
                'transactionItems.transaction',
            ])
            ->withSum([
                'transactionItems as sold_7_days' => function ($q) use ($last7) {
                    $q->whereHas('transaction', function ($t) use ($last7) {
                        $t->where('created_at', '>=', $last7);
                    });
                }
            ], 'quantity')
            ->where('is_active', true);

        /*
        |--------------------------------------------------------------------------
        | FILTER KATEGORI
        |--------------------------------------------------------------------------
        */
        if ($selectedSlug !== 'all') {
            $productQuery->whereHas('category', function ($q) use ($selectedSlug) {
                $q->where('slug', $selectedSlug);
            });
        }

        $products = $productQuery->get();

        /*
        |--------------------------------------------------------------------------
        | 🔥 PRODUK TERLARIS (6 TERBANYAK SOLD 7 HARI, SOLD > 0, HANYA TAB "SEMUA")
        |--------------------------------------------------------------------------
        */
        $bestSellers = collect();

        if ($selectedSlug === 'all') {
            $bestSellers = Product::query()
                ->with([
                    'items.stocks',
                    'transactionItems.transaction',
                ])
                ->withSum([
                    'transactionItems as sold_7_days' => function ($q) use ($last7) {
                        $q->whereHas('transaction', function ($t) use ($last7) {
                            $t->where('created_at', '>=', $last7);
                        });
                    }
                ], 'quantity')
                ->where('is_active', true)
                ->having('sold_7_days', '>', 0)   // ✅ yang belum ada pembelian = tidak masuk
                ->orderByDesc('sold_7_days')
                ->limit(10)                        // ✅ wajib top 6 (kalau kandidatnya ada)
                ->get();
        }

        return view('guest.home', compact(
            'categories',
            'products',
            'bestSellers',
            'selectedSlug'
        ));
    }
}
