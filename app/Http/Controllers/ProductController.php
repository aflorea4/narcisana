<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function checkout(Request $request, Product $product)
    {
        return $request->user()->checkoutCharge($product->price * 100, $product->name, 1);
    }
}
