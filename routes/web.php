<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('homepage');
// })->name('main');
Route::get('/', [HomeController::class, 'index'])->name('main');

// Products Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id?}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id?}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id?}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Wishlist Routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/toggle/{id?}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{id?}', [CheckoutController::class, 'success'])->name('checkout.success');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/products', [ProductController::class, 'allProducts'])->name('product.index');
Route::get('/products/mobile', [ProductController::class, 'allMobile'])->name('product.mobile');
Route::get('/products/laptop', [ProductController::class, 'allLaptop'])->name('product.laptop');
Route::get('/products/tablet', [ProductController::class, 'allTablet'])->name('product.tablet');
Route::get('/products/pc', [ProductController::class, 'allPC'])->name('product.pc');
Route::get('/products/monitor', [ProductController::class, 'allMonitor'])->name('product.monitor');
Route::get('/products/mobileAcc', [ProductController::class, 'allMobileAcc'])->name('product.mobileAcc');
Route::get('/products/laptopAcc', [ProductController::class, 'allLaptopAcc'])->name('product.laptopAcc');
Route::get('/products/audioAcc', [ProductController::class, 'allAudio'])->name('product.audioAcc');
// Route::get('/products/storage', [ProductController::class, 'allTablet'])->name('product.storage');R
Route::get('/products/mobileAcc/charger', [ProductController::class, 'allMobileAccess'])->name('product.mobileAcc.charger');
Route::get('/products/mobileAcc/apdapter', [ProductController::class, 'allAdapter'])->name('product.mobileAcc.apdapter');
Route::get('/products/mobileAcc/case', [ProductController::class, 'allCase'])->name('product.mobileAcc.case');
Route::get('/products/mobileAcc/cable', [ProductController::class, 'allCable'])->name('product.mobileAcc.cable');
Route::get('/product/productdetails/{id}', [ProductController::class, 'productDetails'])->name('product.detail');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Wishlist addWishlist deleteWishlist
    Route::get('/wishlist/{id}', [WishlistController::class, 'addWishlist'])->name('wishlist.add');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'deleteWishlist'])->name('wishlist.remove');

    //Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeCart'])->name('cart.remove');


    //Process Pay
    Route::post('/checktopay', [CartController::class, 'checkToPay'])->name('checktopay');
});



Route::get("/blogs", [BlogController::class, 'index'])->name('blog.index');
Route::get("/blog/details/{id}", [BlogController::class, 'blog'])->name('blog.details');




require __DIR__ . '/auth.php';
