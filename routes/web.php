<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;

// LANDING PAGE
Route::get('/', function () {
    return view('welcome');
})->name('home');

// LEGAL PAGES
Route::view('/terms', 'auth.terms')->name('terms');
Route::view('/privacy-policy', 'auth.privacy-policy')->name('privacy.policy');

// SHARED ROUTES (Accessible by both, protected by Auth & Verified)
Route::middleware(['auth'])->group(function () {

    // Staff Dashboard (Connected to Controller)
    Route::get('/dashboard', [StaffController::class, 'index'])->name('dashboard');

    // STAFF PRODUCT MANAGEMENT (Create & Edit Only)
    Route::get('/staff/products/create', [StaffController::class, 'create'])->name('staff.products.create');
    Route::post('/staff/products', [StaffController::class, 'store'])->name('staff.products.store');
    Route::get('/staff/products/{id}/edit', [StaffController::class, 'edit'])->name('staff.products.edit');
    Route::put('/staff/products/{id}', [StaffController::class, 'update'])->name('staff.products.update');
    
    // STOCK ADJUSTMENT (Stock In / Stock Out)
    Route::post('/staff/stock/adjust', [StaffController::class, 'adjustStock'])->name('staff.stock.adjust');

    // PRINT LABEL
    Route::get('/staff/products/{id}/label', [StaffController::class, 'printLabel'])->name('staff.products.label');
    
    // Profile Routes (Breeze Default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User: submit reports (damage/borrow/other)
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
});

// ADMIN ROUTES (Protected by 'auth', 'verified', AND 'admin' middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Dashboard -> route('admin.dashboard')
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/chart-data', [AdminController::class, 'getChartData'])->name('dashboard.chart');
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
    Route::resource('products', ProductController::class);
    Route::get('/export-inventory', [ReportController::class, 'exportInventory'])->name('export.inventory');
    // Admin report management
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::patch('/reports/{id}/approve', [\App\Http\Controllers\ReportController::class, 'approve'])->name('reports.approve');
    Route::patch('/reports/{id}/reject', [\App\Http\Controllers\ReportController::class, 'reject'])->name('reports.reject');
    Route::get('/activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
    Route::post('/activity-logs/reset', [ActivityLogController::class, 'reset'])->name('activity-logs.reset');
    
    // USER MANAGEMENT (Staff List)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class);
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // REPORTS (User-submitted)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::patch('/reports/{id}/approve', [ReportController::class, 'approve'])->name('reports.approve');
    Route::patch('/reports/{id}/reject', [ReportController::class, 'reject'])->name('reports.reject');
});

require __DIR__.'/auth.php';
