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
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\VerificatorController;
use App\Http\Controllers\LaporanPeroranganController;
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

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

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

    Route::get('/admin/verificator', [VerificatorController::class, 'show'])->name('admin.verificator');
    Route::get('/admin/verificator/add', [VerificatorController::class, 'create'])->name('admin.verificator.create');
    Route::post('/admin/verificator/store', [VerificatorController::class, 'store'])->name('admin.verificator.store');
    Route::get('/admin/verificator/{id}/edit', [VerificatorController::class, 'edit'])->name('admin.verificator.edit');
    Route::put('/admin/verificator/{id}/update', [VerificatorController::class, 'update'])->name('admin.verificator.update');
    Route::delete('/admin/verificator/{id}/delete', [VerificatorController::class, 'destroy'])->name('admin.verificator.delete');

    Route::get('/admin/pelaporan', [PelaporanController::class, 'show'])->name('admin.pelaporan');
    Route::get('/admin/pelaporan/add', [PelaporanController::class, 'create'])->name('admin.pelaporan.create');
    Route::post('/admin/pelaporan/store', [PelaporanController::class, 'store'])->name('admin.pelaporan.store');
    Route::get('/admin/pelaporan/{id}/edit', [PelaporanController::class, 'edit'])->name('admin.pelaporan.edit');
    Route::put('/admin/pelaporan/{id}/update', [PelaporanController::class, 'update'])->name('admin.pelaporan.update');
    Route::delete('/admin/pelaporan/{id}/delete', [PelaporanController::class, 'destroy'])->name('admin.pelaporan.delete');

    Route::get('/admin/periode', [PeriodeController::class, 'show'])->name('admin.periode');
    Route::get('/admin/periode/add', [PeriodeController::class, 'create'])->name('admin.periode.create');
    Route::post('/admin/periode/store', [PeriodeController::class, 'store'])->name('admin.periode.store');
    Route::get('/admin/periode/{id}/edit', [PeriodeController::class, 'edit'])->name('admin.periode.edit');
    Route::put('/admin/periode/{id}/update', [PeriodeController::class, 'update'])->name('admin.periode.update');
    Route::delete('/admin/periode/{id}/delete', [PeriodeController::class, 'destroy'])->name('admin.periode.delete');

    Route::get('/admin/laporan/{id}', [LaporanController::class, 'show'])->name('admin.laporan');

    Route::get('/admin/laporan/{id}/laporan_perorangans', [LaporanPeroranganController::class, 'show'])->name('admin.laporan_perorangan');
    Route::get('/admin/laporan/{id}/laporan_perorangans/add', [LaporanPeroranganController::class, 'create'])->name('admin.laporan_perorangan.create');
    Route::post('/admin/laporan/{id}/laporan_perorangans/store', [LaporanPeroranganController::class, 'store'])->name('admin.laporan_perorangan.store');
    Route::get('/admin/laporan/{id}/laporan_perorangan/detail/{idPerorangan}', [LaporanPeroranganController::class, 'detailByAdmin'])->name('admin.laporan_perorangan.detail');
    Route::get('/admin/laporan/{id}/laporan_perorangans/edit/{idPerorangan}', [LaporanPeroranganController::class, 'edit'])->name('admin.laporan_perorangan.edit');
    Route::get('/admin/laporan/{id}/laporan_perorangans/edit/{idPerorangan}', [LaporanPeroranganController::class, 'edit'])->name('admin.laporan_perorangan.edit');
    Route::put('/admin/laporan/{id}/laporan_perorangans/update/{idPerorangan}', [LaporanPeroranganController::class, 'update'])->name('admin.laporan_perorangan.update');
    Route::delete('/admin/laporan/{id}/laporan_perorangans/delete/{idPerorangan}', [LaporanPeroranganController::class, 'destroy'])->name('admin.laporan_perorangan.delete');

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

    Route::get('/notaris/laporan/{id}/laporan_perorangan', [LaporanPeroranganController::class, 'showByNotaris'])->name('notaris.laporan_perorangan');
    Route::get('/notaris/laporan/{id}/laporan_perorangan/add', [LaporanPeroranganController::class, 'createByNotaris'])->name('notaris.laporan_perorangan.create');
    Route::post('/notaris/laporan/{id}/laporan_perorangan/store', [LaporanPeroranganController::class, 'storeByNotaris'])->name('notaris.laporan_perorangan.store');
    Route::get('/notaris/laporan/{id}/laporan_perorangan/edit/{idPerorangan}', [LaporanPeroranganController::class, 'editByNotaris'])->name('notaris.laporan_perorangan.edit');
    Route::put('/notaris/laporan/{id}/laporan_perorangan/update/{idPerorangan}', [LaporanPeroranganController::class, 'updateByNotaris'])->name('notaris.laporan_perorangan.update');
    Route::get('/notaris/laporan/{id}/laporan_perorangan/detail/{idPerorangan}', [LaporanPeroranganController::class, 'detailByNotaris'])->name('notaris.laporan_perorangan.detail');
    

    Route::post('/notaris/laporan/{id}/ocr', [LaporanController::class, 'ocr'])->name('notaris.laporan.ocr');
    Route::get('/notaris/laporan/{id}/export', [LaporanController::class, 'export'])->name('notaris.laporan.export');
    Route::get('/notaris/account-setting', [NotarisController::class, 'accountSetting'])->name('notaris.account-setting');
    Route::put('/notaris/change-password/{id}', [NotarisController::class, 'changePassword'])->name('notaris.change-password');
    Route::put('/notaris/change-information/{id}', [NotarisController::class, 'changeInformation'])->name('notaris.change-information');
});

Route::middleware(['auth', 'login-check'])->group(function () {
    Route::get('/verificator', [VerificatorController::class, 'index'])->name('verificator.dashboard');

    Route::get('/verificator/pelaporan', [PelaporanController::class, 'showByVerificator'])->name('verificator.pelaporan');

    Route::get('/verificator/laporan/{id}', [LaporanController::class, 'showByVerificator'])->name('verificator.laporan');

    Route::get('/verificator/laporan/{id}/laporan_perorangan', [LaporanPeroranganController::class, 'showByVerificator'])->name('verificator.laporan_perorangan');
    Route::get('/verificator/laporan/{id}/laporan_perorangan/detail/{idPerorangan}', [LaporanPeroranganController::class, 'detailByVerificator'])->name('verificator.laporan_perorangan.detail');
    Route::put('/verificator/laporan/{id}/laporan_perorangan/verifikasi/{idPerorangan}', [LaporanPeroranganController::class, 'verifikasiByVerificator'])->name('verificator.laporan_perorangan.verifikasi');
    Route::put('/verificator/laporan/{id}/laporan_perorangan/tolak/{idPerorangan}', [LaporanPeroranganController::class, 'tolakByVerificator'])->name('verificator.laporan_perorangan.tolak');

    Route::get('/notaris/account-setting', [NotarisController::class, 'accountSetting'])->name('notaris.account-setting');
    Route::put('/notaris/change-password/{id}', [NotarisController::class, 'changePassword'])->name('notaris.change-password');
    Route::put('/notaris/change-information/{id}', [NotarisController::class, 'changeInformation'])->name('notaris.change-information');
});

