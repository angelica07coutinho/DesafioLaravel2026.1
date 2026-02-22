<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PdfController;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [ProdutoController::class, 'homeIndex'])->name('home');

Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto');

Route::get('/dashboard', [CompraController::class, 'vendas'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

        Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
        Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

        Route::post('email/{user}', [EmailController::class, 'email'])->name('users.email');
        });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
        Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
        Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
        Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

        Route::get('/compras', [CompraController::class, 'index'])->name('compras.index');
        Route::get('/compras/pdf', [PdfController::class, 'gerarPdfCompras'])->name('compras.pdf');

        Route::get('/vendas', [CompraController::class, 'vendas'])->name('vendas.index');
        Route::get('/vendas/pdf', [PdfController::class, 'gerarPdfVendas'])->name('vendas.pdf');
    });

    Route::post('/checkout', [CompraController::class, 'checkout'])->name('checkout');
});

require __DIR__.'/auth.php';
