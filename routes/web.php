<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, "index"])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource("barangs", DataBarangController::class);
    Route::get('barangs/print/pdf', [DataBarangController::class, 'print'])->name('barangs.print');
    Route::resource("peminjaman", PeminjamanController::class);
    Route::get('peminjaman/print/pdf', [PeminjamanController::class, 'print'])->name('peminjaman.print');

    Route::resource("pengembalian", PengembalianController::class);
    Route::get('pengembalian/print/pdf', [PengembalianController::class, 'print'])->name('pengembalian.print');

    Route::resource("users", UserController::class);
});

// Route::name('js.')->group(function () {
//     Route::get('dynamic.js', 'JsController@dynamic')->name('dynamic');
// });

require __DIR__ . '/auth.php';
