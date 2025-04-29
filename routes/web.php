<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RubricController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Role pending route - accessible only for authenticated users with 'guest' role
Route::middleware(['auth'])->group(function () {
    Route::get('/role-pending', [RoleController::class, 'pending'])->name('role.pending');
});

// These routes should only be accessible to approved users (admin or lecturer)
Route::middleware(['auth', 'approved'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        // Users
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update.role');
        
        // Categories
        Route::resource('categories', CategoryController::class);
        
        // Rubrics
        Route::resource('rubrics', RubricController::class);
    });
    
    // Lecturer Routes
    Route::middleware(['role:lecturer'])->group(function () {
        // Documents
        Route::resource('documents', DocumentController::class);
        
        // Marks
        Route::get('/marks', [MarkController::class, 'index'])->name('marks.index');
        Route::get('/marks/create/{document}', [MarkController::class, 'create'])->name('marks.create');
        Route::post('/marks/{document}', [MarkController::class, 'store'])->name('marks.store');
        Route::get('/marks/summary', [MarkController::class, 'summary'])->name('marks.summary');
        Route::get('/marks/history/{document}', [MarkController::class, 'history'])->name('marks.history');
    });
});

require __DIR__.'/auth.php';