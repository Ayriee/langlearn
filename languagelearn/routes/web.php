<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin_side\DashboardController;
use App\Http\Controllers\Admin_side\CategoryController;
use App\Http\Controllers\Admin_side\ManageUserController;
use App\Http\Controllers\Admin_side\ReportController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login-form');
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register-form');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');

    Route::get('/reports', [ReportController::class, 'index'])->name('admin_reports');


    Route::get('/Users', [ManageUserController::class, 'index'])->name('manage_users');

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/all', [CategoryController::class, 'showCategory'])->name('categories.all');
        Route::post('/add', [CategoryController::class, 'store'])->name('categories.store');
        Route::post('/get', [CategoryController::class, 'show'])->name('categories.show');
        Route::post('/update', [CategoryController::class, 'update'])->name('categories.update');
        Route::post('/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});



Route::get('/user/landing', function () {
    return view('user.landing');
})->middleware('auth')->name('user.landing');




// Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
//     Route::get('/users', [UserController::class, 'index'])->name('admin.users');
//     Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
//     Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
// });

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
