<?php

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/products/{product:id}', function () {
    return Inertia::render('Products/Show');
})->name('products.show');
Route::middleware(['auth:sanctum', 'verified'])->get('/products', function () {
    return Inertia::render('Products/Index', [
        'products' => Product::all(),
    ]);
})->name('products.index');
Route::middleware(['auth:sanctum', 'verified'])->get('/products/{product:id}', function (Product $product) {
    return Inertia::render('Products/Show', [
        'product' => $product,
    ]);
})->name('products.show');
Route::middleware(['auth:sanctum', 'verified'])->get('/checkout/{product:id}', [ProductController::class, 'checkout'])->name('checkout');

Route::middleware(['auth:sanctum', 'verified'])->post('/checkout/{product:id}/multiple', [ProductController::class, 'checkoutMultiple'])->name('checkout.products');

Route::middleware(['auth:sanctum', 'verified'])->post('/billing-portal', function (Request $request) {
    dd($request->user()->redirectToBillingPortal());

    // return Inertia::render('Products/Index', [
    //     'products' => Product::all(),
    //     'bp_url' => $request->user()->redirectToBillingPortal()->targetUrl
    // ]);
})->name('billing.portal');

//return $request->user()->checkoutCharge(1200, 'T-Shirt', 5);