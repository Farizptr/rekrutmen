<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/lowongan', [AdminController::class, 'lowongan'])->name('admin.lowongan');
    Route::get('/rekrutmen', [AdminController::class, 'rekrutmen'])->name('admin.rekrutmen');
    
    // Add job routes
    Route::get('/lowongan/create', [AdminController::class, 'createJob'])->name('admin.lowongan.create');
    Route::post('/lowongan/store', [AdminController::class, 'storeJob'])->name('admin.lowongan.store');
    
    // Edit job routes
    Route::get('/lowongan/{job}/edit', [AdminController::class, 'editJob'])->name('admin.lowongan.edit');
    Route::put('/lowongan/{job}/update', [AdminController::class, 'updateJob'])->name('admin.lowongan.update');
    
    // Delete job route
    Route::delete('/lowongan/{job}/delete', [AdminController::class, 'deleteJob'])->name('admin.lowongan.delete');
    
    // Toggle job status route
    Route::put('/lowongan/{job}/toggle-status', [AdminController::class, 'toggleJobStatus'])->name('admin.lowongan.toggle-status');
    
    // Job application routes
    Route::put('/rekrutmen/{application}/update-status', [AdminController::class, 'updateApplicationStatus'])->name('admin.rekrutmen.update-status');
});

// User Routes (Protected)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    
    // Lowongan (Job Listings) routes
    Route::get('/lowongan', [UserController::class, 'lowongan'])->name('user.lowongan');
    Route::get('/lowongan/{job}', [UserController::class, 'showJob'])->name('user.lowongan.show');
    Route::post('/lowongan/{job}/apply', [UserController::class, 'applyJob'])->name('user.lowongan.apply');
    
    // Application Status routes
    Route::get('/applications', [UserController::class, 'applications'])->name('user.applications');
});
