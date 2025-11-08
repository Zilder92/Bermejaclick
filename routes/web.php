<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/comercios', [HomeController::class, 'businesses'])->name('businesses.index');
Route::get('/comercios/{slug}', [HomeController::class, 'businessDetail'])->name('businesses.show');

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rutas para promociones de negocios
    Route::post('/dashboard/promotions', [DashboardController::class, 'storePromotion'])->name('promotions.store');
    Route::get('/dashboard/promotions', [DashboardController::class, 'listPromotions'])->name('promotions.list');
    
    // Rutas de administración
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/businesses', [AdminController::class, 'businesses'])->name('businesses');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/promotions', [AdminController::class, 'promotions'])->name('promotions');
        Route::post('/businesses/{id}/toggle', [AdminController::class, 'toggleBusinessStatus'])->name('businesses.toggle');
        Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');
        Route::post('/promotions/{id}/toggle', [AdminController::class, 'togglePromotionStatus'])->name('promotions.toggle');
        Route::delete('/businesses/{id}', [AdminController::class, 'deleteBusiness'])->name('businesses.delete');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        
        // Rutas de registro solo para administradores
        Route::get('/users/create', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/users/create', [RegisterController::class, 'register']);
    });
});

