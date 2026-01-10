<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemStock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // PAGE UTAMA
    public function index(Request $request)
    {
        $q = $request->q;

        $items = Item::with('product')
            ->withCount('stocks')
            ->when($q, function ($query) use ($q) {
                $query->where('name', 'like', "%$q%")
                      ->orWhereHas('product', function ($sq) use ($q) {
                          $sq->where('name', 'like', "%$q%");
                      });
            })
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.stocks.index', compact('items', 'q'));
    }

    // FORM TAMBAH STOK
    public function create(Item $item)
    {
        return view('admin.stocks.create', compact('item'));
    }

    // SIMPAN: AUTO-DETECT MULTI/SINGLE STOK
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'data' => 'required|string',
        ]);

        $input = trim($request->data);
        $stocks = [];

        // Cek apakah ada pola angka dengan titik di awal baris (1., 2., dll)
        if (preg_match('/^\s*\d+\./', $input)) {
            // Mode Multi Stok
            // Split berdasarkan pola: angka dengan titik di awal baris
            $pattern = '/(?=\n\s*\d+\.|^\s*\d+\.)/';
            $parts = preg_split($pattern, $input, -1, PREG_SPLIT_NO_EMPTY);
            
            foreach ($parts as $part) {
                $part = trim($part);
                if (!empty($part)) {
                    // Hilangkan nomor di awal (contoh: "1. ", "2.")
                    $cleaned = preg_replace('/^\d+\.\s*/', '', $part);
                    $stocks[] = $cleaned;
                }
            }
        } else {
            // Mode Single Stok
            $stocks[] = $input;
        }

        // Simpan ke database
        $savedCount = 0;
        foreach ($stocks as $stockData) {
            $stockData = trim($stockData);
            if (!empty($stockData)) {
                ItemStock::create([
                    'item_id' => $item->id,
                    'data'    => $stockData,
                ]);
                $savedCount++;
            }
        }

        if ($savedCount > 0) {
            $message = $savedCount == 1 
                ? "1 stok berhasil ditambahkan." 
                : "{$savedCount} stok berhasil ditambahkan.";
                
            return redirect()
                ->route('admin.stocks.index')
                ->with('success', $message);
        }

        return back()->with('error', 'Tidak ada stok valid yang ditambahkan.');
    }

    // LIHAT LIST STOK
    public function show(Item $item)
    {
        $stocks = $item->stocks()->orderBy('id')->get();

        return view('admin.stocks.show', compact('item', 'stocks'));
    }

    // HAPUS STOK
    public function destroy(ItemStock $stock)
    {
        $stock->delete();

        return redirect()->back()->with('success', 'Stok berhasil dihapus.');
    }
}