<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Editor\DashboardController as EditorDashboardController;
use App\Http\Controllers\Author\DashboardController as AuthorDashboardController;

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
Route::middleware('web')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']); 
});


Route::middleware(['auth','role:Admin'])->prefix('admin')->name('admin.')->group(function () 
{
    Route::get('dashboard', [AdminDashboardController::class,'index'])->name('dashboard');
});

Route::middleware(['auth','role:Editor'])->prefix('editor')->name('editor.')->group(function () 
{
    Route::get('dashboard', [EditorDashboardController::class,'index'])->name('dashboard');
});

Route::middleware(['auth','role:Author'])->prefix('author')->name('author.')->group(function () 
{
    Route::get('dashboard', [AuthorDashboardController::class,'index'])->name('dashboard');
});

