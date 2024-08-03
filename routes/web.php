<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\MainSliderController;
use App\Http\Controllers\ReviewSliderController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\NotarisController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontPageController::class, 'index'])->name('home');
Route::get('/catalog', [FrontPageController::class, 'catalog'])->name('catalog');
Route::get('/catalog/product/{slug}', [FrontPageController::class, 'productDetail'])->name('product.detail');

/* Authentication Routes... */
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Auth::routes([
    'register' => false, // Register Routes...
    'reset' => false, // Reset Password Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::middleware(['auth', 'login-check'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/notaris', [NotarisController::class, 'show'])->name('admin.notaris');
    Route::get('/admin/notaris/add', [NotarisController::class, 'create'])->name('admin.notaris.create');
    Route::post('/admin/notaris/store', [NotarisController::class, 'store'])->name('admin.notaris.store');
    Route::get('/admin/notaris/{id}/edit', [NotarisController::class, 'edit'])->name('admin.notaris.edit');
    Route::put('/admin/notaris/{id}/update', [NotarisController::class, 'update'])->name('admin.notaris.update');
    Route::delete('/admin/notaris/{id}/delete', [NotarisController::class, 'destroy'])->name('admin.notaris.delete');

    Route::get('/admin/pelaporan', [PelaporanController::class, 'show'])->name('admin.pelaporan');
    Route::get('/admin/pelaporan/add', [PelaporanController::class, 'create'])->name('admin.pelaporan.create');
    Route::post('/admin/pelaporan/store', [PelaporanController::class, 'store'])->name('admin.pelaporan.store');
    Route::get('/admin/pelaporan/{id}/edit', [PelaporanController::class, 'edit'])->name('admin.pelaporan.edit');
    Route::put('/admin/pelaporan/{id}/update', [PelaporanController::class, 'update'])->name('admin.pelaporan.update');
    Route::delete('/admin/pelaporan/{id}/delete', [PelaporanController::class, 'destroy'])->name('admin.pelaporan.delete');

    Route::get('/admin/laporan/{id}', [LaporanController::class, 'show'])->name('admin.laporan');

    Route::get('/admin/account-setting', [AdminController::class, 'accountSetting'])->name('admin.account-setting');
    Route::put('/admin/change-password/{id}', [AdminController::class, 'changePassword'])->name('admin.change-password');
    Route::put('/admin/change-information/{id}', [AdminController::class, 'changeInformation'])->name('admin.change-information');
});

Route::middleware(['auth', 'login-check'])->group(function () {
    Route::get('/notaris', [NotarisController::class, 'index'])->name('notaris.dashboard');

    Route::get('/notaris/pelaporan', [PelaporanController::class, 'showByNotaris'])->name('notaris.pelaporan');
    Route::get('/notaris/pelaporan/add', [PelaporanController::class, 'createByNotaris'])->name('notaris.pelaporan.create');
    Route::post('/notaris/pelaporan/store', [PelaporanController::class, 'storeByNotaris'])->name('notaris.pelaporan.store');
    Route::get('/notaris/pelaporan/{id}/edit', [PelaporanController::class, 'editByNotaris'])->name('notaris.pelaporan.edit');
    Route::put('/notaris/pelaporan/{id}/update', [PelaporanController::class, 'updateByNotaris'])->name('notaris.pelaporan.update');
    Route::delete('/notaris/pelaporan/{id}/delete', [PelaporanController::class, 'destroyByNotaris'])->name('notaris.pelaporan.delete');

    Route::get('/notaris/laporan/{id}', [LaporanController::class, 'showByNotaris'])->name('notaris.laporan');
    Route::get('/notaris/laporan/{id}/edit', [LaporanController::class, 'editByNotaris'])->name('notaris.laporan.edit');
    Route::put('/notaris/laporan/{id}/update', [LaporanController::class, 'updateByNotaris'])->name('notaris.laporan.update');
    Route::get('/notaris/laporan/{id}/detail', [LaporanController::class, 'detailByNotaris'])->name('notaris.laporan.detail');

    Route::get('/notaris/account-setting', [NotarisController::class, 'accountSetting'])->name('notaris.account-setting');
    Route::put('/notaris/change-password/{id}', [NotarisController::class, 'changePassword'])->name('notaris.change-password');
    Route::put('/notaris/change-information/{id}', [NotarisController::class, 'changeInformation'])->name('notaris.change-information');
});

