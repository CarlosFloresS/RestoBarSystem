<?php

use App\Enums\Role;
use App\Http\Controllers\KitchenOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TakeOrderController;
use App\Http\Controllers\UpdateOrdersStatusController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware(RoleMiddleware::class . ':' . Role::Frontline->value)->group(function () {
        Route::get('/orders/take/tables/{table}', [TakeOrderController::class, 'create']);
        Route::post('/orders/take/tables/{table}', [TakeOrderController::class, 'store']);
        Route::put('/orders/{order}', [TakeOrderController::class, 'update']);
    });

    Route::middleware(RoleMiddleware::class . ':' . Role::Kitchen->value)->group(function () {
        Route::get('/orders/kitchen', [KitchenOrderController::class, 'index']);
        Route::put('/update-orders-status/{order}', [UpdateOrdersStatusController::class, 'update']);
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
