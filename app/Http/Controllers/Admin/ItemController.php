<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    // ===============================
    // INDEX - LIST PRODUK
    // ===============================
    public function index(Request $request)
    {
        $q = $request->q;

        $products = Product::withCount('items')
            ->when($q, fn ($query) =>
                $query->where('name', 'like', "%{$q}%")
            )
            ->orderBy('name')
            ->paginate(20);

        return view('admin.items.index', compact('products', 'q'));
    }

    // ===============================
    // CREATE
    // ===============================
    public function create(Request $request)
    {
        $products = Product::orderBy('name')->get();
        $selectedProduct = null;

        if ($request->filled('product_id')) {
            $selectedProduct = Product::find($request->product_id);
        }

        return view('admin.items.create', compact('products', 'selectedProduct'));
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => [
                'required',
                'string',
                Rule::unique('items')->where(fn ($q) =>
                    $q->where('product_id', $request->product_id)
                ),
            ],
            'price_guest' => 'required|numeric|min:0',
            'price_reseller' => 'required|numeric|min:0',
        ], [
            'name.unique' => 'Nama item sudah ada pada produk ini.',
        ]);

        Item::create($request->only([
            'product_id',
            'name',
            'price_guest',
            'price_reseller',
        ]));

        return redirect()
            ->route('admin.items.index')
            ->with('success', 'Item berhasil ditambahkan.');
    }

    // ===============================
    // SHOW ITEM PER PRODUK
    // ===============================
    public function showProduct($product_id)
    {
        $product = Product::findOrFail($product_id);

        $items = $product->items()
            ->withCount('stocks')
            ->orderByDesc('id')
            ->get();

        return view('admin.items.show', compact('product', 'items'));
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit(Item $item)
    {
        $products = Product::orderBy('name')->get();
        return view('admin.items.edit', compact('item', 'products'));
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, Item $item)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => [
                'required',
                'string',
                Rule::unique('items')
                    ->where(fn ($q) =>
                        $q->where('product_id', $request->product_id)
                    )
                    ->ignore($item->id),
            ],
            'price_guest' => 'required|numeric|min:0',
            'price_reseller' => 'required|numeric|min:0',
        ], [
            'name.unique' => 'Nama item sudah ada pada produk ini.',
        ]);

        $item->update($request->only([
            'product_id',
            'name',
            'price_guest',
            'price_reseller',
        ]));

        return redirect()
            ->route('admin.items.product.show', $item->product_id)
            ->with('success', 'Item berhasil diperbarui.');
    }

    // ===============================
    // DELETE
    // ===============================
    public function destroy(Item $item)
    {
        $productId = $item->product_id;
        $item->delete();

        return redirect()
            ->route('admin.items.product.show', $productId)
            ->with('success', 'Item berhasil dihapus.');
    }
}
