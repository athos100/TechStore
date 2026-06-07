<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
use Illuminate\Support\Facades\URL;

Route::get('/teste-link-assinado', function () {
    return URL::temporarySignedRoute(
        'acao-segura',
        now()->addMinutes(10),
        ['user' => 15]
    );
});

Route::get('/acao-segura', function () {
    return 'Acesso permitido: assinatura válida.';
})->name('acao-segura')->middleware('signed');
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/cadastro', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/produtos', [CatalogController::class, 'index'])->name('store.products.index');
Route::get('/produtos/{product}', [CatalogController::class, 'show'])->name('store.products.show');

Route::get('/carrinho', [CartController::class, 'index'])->name('cart.index');
Route::post('/carrinho/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/carrinho/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/carrinho/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware('auth')->group(function (): void {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'place'])->name('checkout.place');

    Route::get('/meus-pedidos', [MyOrderController::class, 'index'])->name('orders.my');
    Route::post('/produtos/{product}/avaliacoes', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/produtos/{product}/avaliacoes', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::patch('/products/{product}/reactivate', [AdminProductController::class, 'reactivate'])->name('products.reactivate');
    Route::resource('products', AdminProductController::class)->except(['show']);

    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
});
