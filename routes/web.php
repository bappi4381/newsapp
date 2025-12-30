<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\NewsController;

Route::get('/', [NewsController::class, 'index'])->name('home');
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);


Route::middleware(['auth'])->group(function () {

    // Role-based dashboard redirect
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---------------------------
    // Admin-only routes
    // ---------------------------
    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::get('category-subcategory', [CategoryController::class, 'index'])->name('category_subcategory.index');
        Route::resource('categories', CategoryController::class)->only(['store', 'destroy']);
        Route::resource('subcategories', SubcategoryController::class)->only(['store', 'destroy']);

        // Add route for getting subcategories (e.g., for AJAX dependent dropdowns)
        Route::get('/categories/by-type/{type}', [CategoryController::class, 'getByType'])->name('categories.byType');
        Route::get('get-subcategories', [SubcategoryController::class, 'getSubcategories'])->name('get.subcategories');
        Route::get('/subcategories/by-category/{id}', [SubcategoryController::class, 'byCategory'])->name('subcategories.byCategory');
    });

    // ---------------------------
    // Article routes
    // ---------------------------
    Route::middleware(['role:Admin|Editor|Author'])->group(function () {

        // List all articles (Editor & Admin)
        Route::get('articles', [ArticleController::class, 'index'])
            ->middleware('can:edit-article')
            ->name('articles.index');

        // Create article (Author & Admin)
        Route::get('articles/create', [ArticleController::class, 'create'])
            ->middleware('can:create-article')
            ->name('articles.create');
        Route::post('articles', [ArticleController::class, 'store'])
            ->middleware('can:create-article')
            ->name('articles.store');

        // Edit article (Editor & Admin)
        Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])
            ->middleware('can:edit-article')
            ->name('articles.edit');
        Route::put('articles/{article}', [ArticleController::class, 'update'])
            ->middleware('can:edit-article')
            ->name('articles.update');

        // Publish article (Editor & Admin)
        Route::get('articles/publish', [ArticleController::class, 'publish'])
            ->middleware('can:publish-article')
            ->name('articles.publish');

        // Deleted articles (Admin only or as per permission)
        Route::get('articles/deleted', [ArticleController::class, 'deleted'])
            ->middleware('can:delete-article')
            ->name('articles.deleted');
    });

    // Logout route
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

});


