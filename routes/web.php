<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Apps\backend\v1\BrandController;

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/brands', [App\Http\Controllers\backend\v1\BrandController::class, 'index'])->name('brand.index');
    Route::post('/brands-store', [App\Http\Controllers\backend\v1\BrandController::class, 'brandStore'])->name('brand.store');
    Route::get('/categories', [App\Http\Controllers\backend\v1\CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories-store', [App\Http\Controllers\backend\v1\CategoryController::class, 'categoryStore'])->name('category.store');
    Route::get('/models', [App\Http\Controllers\backend\v1\ModelController::class, 'index'])->name('model.index');
    Route::post('/models-store', [App\Http\Controllers\backend\v1\ModelController::class, 'modelStore'])->name('model.store');

    Route::get('/products', [App\Http\Controllers\backend\v1\ProductController::class, 'index'])->name('product.index');
    Route::post('/product-store', [App\Http\Controllers\backend\v1\ProductController::class, 'productStore'])->name('product.store');



    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
