<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductViewController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['items.stocks']);

        return view('guest.product_show', compact('product'));
    }
}
