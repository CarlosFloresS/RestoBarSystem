<?php

use App\Http\Controllers\KitchenOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TakeOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/orders/take/tables/{table}', [TakeOrderController::class, 'create']);
    Route::post('/orders/take/tables/{table}', [TakeOrderController::class, 'store']);
    Route::put('/orders/{order}', [TakeOrderController::class, 'update']);
    Route::get('/orders/kitchen', [KitchenOrderController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
