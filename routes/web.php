<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ChangePasswordController;

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

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'loginForm']);
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/user/profile', [UserProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/user/profile/delete-photo', [UserProfileController::class, 'deletePhoto']);

    Route::get('/user/change-password', [ChangePasswordController::class, 'edit'])->name('change-password.edit');
    Route::patch('/user/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // Manage Employees Routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
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

// require __DIR__.'/auth.php';
