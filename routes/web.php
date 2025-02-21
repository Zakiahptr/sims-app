<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

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




Auth::routes();

// Route::get('/',  [HomeController::class, 'index'])->name('home');
// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
Route::controller(ProductController::class)->name('product.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('produk/tambah', 'create')->name('create');
    Route::post('produk/store', 'store')->name('store');
    Route::get('produk/{product}/edit', 'edit')->name('edit');
    Route::patch('produk/{product}/update', 'update')->name('update');
    Route::delete('produk/{product}', 'destroy')->name('destroy');
    Route::get('/export-excel', 'exportExcel')->name('export');


});

Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
});

Route::get('/images/{filename}', function ($filename) {
    $path = storage_path("app/public/uploads/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('image.view');
