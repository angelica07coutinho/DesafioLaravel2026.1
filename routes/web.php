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

Route::get('/home', [ProdutoController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/users', [UsersController::class, 'index'])->name('users.index');

Route::post('/admin/users', [RegisteredUserController::class, 'store'])
    ->middleware(['auth'])->name('admin.users.store');

Route::put('/admin/users/{user}', [UsersController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

require __DIR__.'/auth.php';
