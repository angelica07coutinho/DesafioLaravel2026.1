<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProdutoController;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [ProdutoController::class, 'homeIndex'])->name('home');

Route::get('/produto/{produto}', [ProdutoController::class, 'show'])->name('produto');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
        Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
        Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
        Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
        Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
    });
});

Route::get('/admin/users', [UsersController::class, 'index'])->name('users.index');
Route::post('/admin/users', [RegisteredUserController::class, 'store'])->name('users.store');
Route::put('/admin/users/{user}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

require __DIR__.'/auth.php';
