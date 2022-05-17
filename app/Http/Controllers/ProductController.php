<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function checkout(Request $request, Product $product)
    {
        $checkout = $request->user()->checkoutCharge($product->price * 100, $product->name, 1);
        return Inertia::render('Products/Index', [
            'products' => Product::all(),
            'checkout_url' => $checkout->url
        ]);
    }

    public function checkoutMultiple(Request $request, Product $product)
    {
        //TODO add validation
        //? Quantity check
        $checkout = $request->user()->checkoutCharge($product->price * 100, $product->name, $request->quantity);
        return Inertia::render('Products/Index', [
            'products' => Product::all(),
            'checkout_url' => $checkout->url
        ]);
    }
}
