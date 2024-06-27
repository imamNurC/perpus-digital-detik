<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {        //nama Fungsi           //nama Routes yang akan di trigger di view
    Route::get('/list-books', [UserController::class, 'listBooks'])->name('listBooks');
    Route::get('/tambah-buku', [UserController::class, 'createBookForm'])->name('createBook');
    Route::post('/tambah-buku', [UserController::class, 'storeBook'])->name('storeBook');
    Route::get('/dashboard', function(){
        return view('dashboard.index');
    })->name('dash');



    Route::get('/list-books/{kategori?}', [UserController::class, 'listBooks'])->name('listBooks');
    Route::delete('/delete-book/{id}', [UserController::class, 'deleteBook'])->name('deleteBook');
    Route::get('/edit-book/{id}', [UserController::class, 'editBookForm'])->name('editBookForm');
    Route::put('/update-book/{id}', [UserController::class, 'updateBook'])->name('updateBook');
    Route::get('/detail-book/{id}', [UserController::class, 'detailBook'])->name('detailBook');
    Route::get('/export-pdf/{id}', [UserController::class, 'exportPdf'])->name('exportPdf');

    // Categories master
    Route::get('/categories', [CategoryController::class, 'listDataKategori'])->name('categories');
    Route::get('/tambah-kategori-buku', [CategoryController::class, 'createBookCategoryForm'])->name('createBookCategory');
    Route::post('/tambah-kategori-buku', [CategoryController::class, 'storeBookCategory'])->name('storeBookCategory');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteBookCategory'])->name('deleteBookCategory');
    Route::get('/edit-category/{id}', [CategoryController::class, 'editBookCategoryForm'])->name('editBookCategoryForm');
    Route::put('/update-category/{id}', [CategoryController::class, 'updateBookCategory'])->name('updateBookCategory');
});