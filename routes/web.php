<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    $imageUrl = asset('images/DICT-BANNER.png');
    return Inertia::render('Welcome', [
        'imageUrl' => $imageUrl,
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
    // Route::post('/subcategory/add-new', [SubCategoryController::class, 'store'])->name('subcategory.store');
});

Route::get('/test', function(){
    return Inertia::render('test');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::post('/categories/new-category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::patch('/categories/update/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categories/remove/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/categories/{category}/subcategories', [SubCategoryController::class, 'index'])->name('subcategory.index');
Route::post('/categories/{category}/subcategories/new-subcategory', [SubCategoryController::class, 'store'])->name('subcategory.store');
Route::patch('/subcategories/{subCategory}/update', [SubCategoryController::class, 'update'])->name('subcategory.update');
Route::delete('/subcategories/{subCategory}/delete', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');

require __DIR__.'/auth.php';
