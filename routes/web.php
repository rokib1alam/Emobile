<?php

use Illuminate\Support\Facades\Route;

// Frontend Controllers
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\ReviewController;
use App\Http\Controllers\Front\CompareController;

// User Controller
use App\Http\Controllers\User\SellController;
use App\Http\Controllers\User\OrderController;

// SSLCommerz Payment Controller
use App\Http\Controllers\SslcommerzController;

// Sitemap Package
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
require __DIR__.'/admin-dashboard.php';
require __DIR__.'/user.php';

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::group([], function () {

    // Homepage
    Route::get('/', [FrontendController::class, 'index'])->name('index');
    Route::get('/about', [FrontendController::class, 'About'])->name('about');
    Route::get('/contact', [FrontendController::class, 'Contact'])->name('contact');

    // Product Details
    Route::get('/products/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
    Route::get('/product-quick-view/{id}', [FrontendController::class, 'productQuickView']);

    // Cart Routes
    Route::post('/add-to-cart', [CartController::class, 'addToCartQV'])->name('add.to.cart.quickview');
    Route::get('/cart/items', [CartController::class, 'getCartItems'])->name('cart.items');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.view');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{rowId}', [CartController::class, 'destroy'])->name('cart.remove');

    // Checkout Routes (User must be logged in)
    Route::middleware(['auth'])->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
        Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.submit');

        // Invoice page after payment success

        Route::get('/order/invoice/{id}', [CheckoutController::class, 'invoice'])->name('order.invoice');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });

    // SSLCommerz Callback Routes (No auth middleware)
    Route::controller(SslcommerzController::class)
        ->prefix('sslcommerz')
        ->name('sslc.')
        ->group(function () {
            Route::post('success', 'success')->name('success');
            Route::post('failure', 'failure')->name('failure');
            Route::post('cancel', 'cancel')->name('cancel');
            Route::post('ipn', 'ipn')->name('ipn');
        });

    // Search & Compare
    Route::get('/search-result/{query}', [FrontendController::class, 'fullSearch'])->name('search.page');
    Route::get('/ajax-search', [FrontendController::class, 'ajaxSearch'])->name('ajax.search');
    Route::get('/compare', [CompareController::class, 'viewCompare'])->name('compare.page');
    Route::get('/add-to-compare/{id}', [CompareController::class, 'addToCompare'])->name('compare.add');
    Route::get('/compare/remove/{id}', [CompareController::class, 'removeFromCompare'])->name('compare.remove');

    // Wishlist & Reviews
    Route::get('/wishlist', [ReviewController::class, 'wishlist'])->name('wishlist');
    Route::post('/wishlist/remove', [ReviewController::class, 'remove'])->name('wishlist.remove');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/add/wishlist/{id}', [ReviewController::class, 'addWishlist'])->name('wishlist.add');

    // Static pages
    Route::get('/new', [FrontendController::class, 'new'])->name('new');

    // Catch-all slug route (must be last)
    Route::get('{slug}', [FrontendController::class, 'slugHandler'])->name('slug.handler');
});




// Route::get('/service', [FrontendController::class, 'service'])->name('service');
// Route::get('/team', [FrontendController::class, 'team'])->name('team');
// Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
// Route::post('/contact-submit', [FrontendController::class, 'contact_submit'])->name('contact.submit');
// Route::get('/projects', [FrontendController::class, 'project'])->name('projects');
// Route::get('/projects/{project}', [FrontendController::class, 'project_details'])->name('projects.details');


/*
|--------------------------------------------------------------------------
| Sitemap Generator (Optional)
|--------------------------------------------------------------------------
*/
Route::get('/generate-sitemap', function () {
    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/about'))
        ->add(Url::create('/service'))
        ->add(Url::create('/team'))
        ->add(Url::create('/projects'))
        ->add(Url::create('/contact'))
        ->add(Url::create('/projects/{id}'))
        ->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap generated!';
});

