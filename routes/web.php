<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SparePartController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Home page - Main dealership dashboard
Route::get('/', [DealershipController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DealershipController::class, 'index'])->name('dashboard');
    
    // Resource routes
    Route::resource('cars', CarController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('spare-parts', SparePartController::class);
    
    // Convenience routes with different names
    Route::get('inventory', [CarController::class, 'index'])->name('inventory');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
