<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Halaman landing / (welcome)
     */
    public function index()
    {
        // Ambil semua kategori yang punya product
        $categories = Category::with(['products'])
            ->orderBy('name')
            ->get();

        // Tentukan kategori awal (pertama)
        $initialCategory = $categories->first();

        // Data awal tabel harga (biar gak kosong kalau JS mati)
        $initialItems = collect();

        if ($initialCategory) {
            $initialItems = $this->getItemsByCategoryId($initialCategory->id);
        }

        return view('welcome', compact('categories', 'initialCategory', 'initialItems'));
    }

    /**
     * Endpoint AJAX untuk ambil daftar harga per kategori
     * GET /price-list?category=slug
     */
    public function priceList(Request $request)
    {
        $slug = $request->query('category');

        if (!$slug) {
            return response()->json([
                'items' => [],
                'message' => 'Category slug is required',
            ], 400);
        }

        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                'items' => [],
                'message' => 'Category not found',
            ], 404);
        }

        $items = $this->getItemsByCategoryId($category->id);

        return response()->json([
            'items' => $items,
        ]);
    }

    /**
     * Helper: ambil item by category_id dengan join product
     * Output: collection array:
     * [
     *   'product_name'  => 'Spotify Premium',
     *   'item_name'     => '1 Bulan',
     *   'price_reseller'=> 10000,
     *   'price_guest'   => 12000,
     *   'stock'         => 5,
     *   'status'        => 'Ready',
     * ]
     */
    private function getItemsByCategoryId(int $categoryId)
    {
        $items = Item::select('items.*')
            ->with(['product'])
            ->withCount('stocks')
            ->whereHas('product', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->orderBy('items.name')
            ->get();

        return $items->map(function ($item) {
            $stockCount = $item->stocks_count ?? 0;

            return [
                'product_name'   => $item->product ? $item->product->name : '-',
                'item_name'      => $item->name,
                'price_reseller' => (int) $item->price_reseller,
                'price_guest'    => (int) $item->price_guest,
                'stock'          => $stockCount,
                'status'         => $stockCount > 0 ? 'Ready' : 'Close',
            ];
        });
    }
}
