<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\MarketplaceController;
use App\Http\Controllers\Admin\ProducerController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\SellerController as AdminSellerController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\ClientController as SiteClientController;
use App\Http\Controllers\Site\OrderController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\ReviewController as SiteReviewController;
use App\Http\Controllers\Site\SellerController as SiteSellerController;

/*
| Web Routes:
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider
| and all of them will be assigned to the "web" middleware group.
*/

Route::get('/welcome', function () {
    return view('welcome');
});

// Automated Redirect of Homepage with localization:
Route::get('/', function () {
    return redirect(app()->getLocale());
});

// Routes without '{locale}' because of get-parameter conflict:
Route::get('/product/show/{id_product}', [ProductController::class, 'show'])->name('product.show');
Route::middleware('authClient')->group(function () {
    Route::get('/client/edit/{id_client}', [SiteClientController::class, 'edit'])->name('client.edit');
});
Route::middleware('authSeller')->group(function () {
    Route::get('/seller/edit/{id_seller}', [SiteSellerController::class, 'edit'])->name('seller.edit');
    Route::get('/product/edit/{id_product}', [ProductController::class, 'edit'])->name('product.edit');
});
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/marketplace/edit/{id_marketplace}', [MarketplaceController::class, 'edit'])->name('admin.marketplace.edit');
        Route::get('/producer/edit/{id_producer}', [ProducerController::class, 'edit'])->name('admin.producer.edit');
        Route::get('/category/edit/{id_category}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::get('/subcategory/edit/{id_subcategory}', [SubcategoryController::class, 'edit'])->name('admin.subcategory.edit');
    });
});

// Site
Route::prefix('{locale}')->group(function () {
    Route::controller(GeneralController::class)->group(function () {
        Route::post('/switch_language', 'switchLanguage')->name('switchLanguage');
        Route::get('/', 'index')->name('index');
        Route::get('/registration_seller', 'registerSeller')->name('registration_seller');
        Route::post('/registration_seller', 'storeSeller')->name('registration_seller');
        Route::get('/registration_client', 'registerClient')->name('registration_client');
        Route::post('/registration_client', 'storeClient')->name('registration_client');
        Route::get('/auth', 'auth')->name('auth');
        Route::post('/auth', 'auth')->name('auth');
        Route::post('/log_out', 'logout')->name('log_out');
    });
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product');
        Route::post('/product', 'index')->name('product');
    });
    Route::controller(CartController::class)->group(function () {
        Route::post('/add_to_cart', 'store')->name('cart_store');
        Route::get('/cart', 'index')->name('cart');
        Route::post('/cart', 'index')->name('cart');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/order/create', 'create')->name('order.create');
        Route::post('/order/make', 'store')->name('order.make');
    });

    Route::middleware('authClient')->group(function () {
        Route::controller(SiteClientController::class)->group(function () {
            Route::get('/client/personal', 'show')->name('client.personal');
            Route::patch('/client/update', 'update')->name('client.update');
            Route::delete('/client/delete', 'destroy')->name('client.delete');
        });
        Route::controller(SiteReviewController::class)->group(function () {
            Route::post('/review/add', 'store')->name('review.add');
            Route::patch('/review/update', 'update')->name('review.update');
            Route::delete('/review/destroy', 'destroy')->name('review.destroy');
        });
    });

    Route::middleware('authSeller')->group(function () {
        Route::controller(SiteSellerController::class)->group(function () {
            Route::get('/seller/personal', 'show')->name('seller.personal');
            Route::patch('/seller/update', 'update')->name('seller.update');
            Route::delete('/seller/delete', 'destroy')->name('seller.delete');
        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/my_products', 'sellerProducts')->name('product.my_products');
            Route::get('/product/create', 'create')->name('product.create');
            Route::post('/product/store', 'store')->name('product.store');
            Route::patch('/product/update', 'update')->name('product.update');
            Route::delete('/product/delete', 'destroy')->name('product.delete');
            Route::patch('/product/restore', 'restore')->name('product.restore');
        });
        Route::controller(OrderController::class)->group(function () {
            Route::get('/order/my_orders', 'index')->name('order.my_orders');
            Route::patch('/order/my_orders', 'update')->name('order.my_orders');
        });
    });

    // Admin Panel
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('admin')->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::get('/', 'dashboard')->name('admin.dashboard');
                Route::get('/admins', 'admins')->name('admin.admins');
            });

            Route::controller(MarketplaceController::class)->group(function () {
                Route::get('/marketplace', 'index')->name('admin.marketplace');
                Route::get('/marketplace/create', 'create')->name('admin.marketplace.create');
                Route::post('/marketplace/store', 'store')->name('admin.marketplace.store');
                Route::patch('/marketplace/update', 'update')->name('admin.marketplace.update');
                Route::delete('/marketplace/delete', 'destroy')->name('admin.marketplace.delete');
                Route::patch('/marketplace/restore', 'restore')->name('admin.marketplace.restore');
            });
            Route::controller(ProducerController::class)->group(function () {
                Route::get('/producer', 'index')->name('admin.producer');
                Route::get('/producer/create', 'create')->name('admin.producer.create');
                Route::post('/producer/store', 'store')->name('admin.producer.store');
                Route::patch('/producer/update', 'update')->name('admin.producer.update');
                Route::delete('/producer/delete', 'destroy')->name('admin.producer.delete');
                Route::patch('/producer/restore', 'restore')->name('admin.producer.restore');
            });
            Route::controller(CategoryController::class)->group(function () {
                Route::get('/category', 'index')->name('admin.category');
                Route::get('/category/create', 'create')->name('admin.category.create');
                Route::post('/category/store', 'store')->name('admin.category.store');
                Route::patch('/category/update', 'update')->name('admin.category.update');
                Route::delete('/category/delete', 'destroy')->name('admin.category.delete');
                Route::patch('/category/restore', 'restore')->name('admin.category.restore');
            });
            Route::controller(SubcategoryController::class)->group(function () {
                Route::get('/subcategory', 'index')->name('admin.subcategory');
                Route::get('/subcategory/create', 'create')->name('admin.subcategory.create');
                Route::post('/subcategory/store', 'store')->name('admin.subcategory.store');
                Route::patch('/subcategory/update', 'update')->name('admin.subcategory.update');
                Route::delete('/subcategory/delete', 'destroy')->name('admin.subcategory.delete');
                Route::patch('/subcategory/restore', 'restore')->name('admin.subcategory.restore');
            });
            Route::controller(AdminSellerController::class)->group(function () {
                Route::get('/seller', 'index')->name('admin.seller');
                Route::delete('/seller/block', 'block')->name('admin.seller.block');
                Route::patch('/seller/unblock', 'unblock')->name('admin.seller.unblock');
            });
            Route::controller(AdminClientController::class)->group(function () {
                Route::get('/client', 'index')->name('admin.client');
                Route::delete('/client/block', 'block')->name('admin.client.block');
                Route::patch('/client/unblock', 'unblock')->name('admin.client.unblock');
            });
            Route::controller(AdminReviewController::class)->group(function () {
                Route::get('/reviews', 'index')->name('admin.reviews');
                Route::patch('/review/change', 'change')->name('admin.review.change');
            });
        });
    });
});

require __DIR__ . '/auth.php';
