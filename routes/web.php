<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('verified')->name('home');
//products
Route::prefix('products')->middleware('verified')->name('products.')->controller(ProductController::class)->group(function () { // routing group to make unrepeated code
    Route::get('/all', 'index')->name('index');
    //create
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/update/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'delete')->name('delete');
});
// brands
Route::prefix('brands')->middleware('verified')->name('brands.')->controller(BrandController::class)->group(function () {
    Route::get('/all', 'index')->name('index');
    //create
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    //edit
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    //delete
    Route::get('/delete/{id}', 'delete')->name('delete');
});
// catigories
Route::prefix('catigories')->middleware('verified')->name('catigories.')->controller(CatigoryController::class)->group(function () {
    Route::get('/all', 'index')->name('index');
    //create
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    //edit
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::post('/update/{id}', 'update')->name('update');
    //delete
    Route::get('/delete/{id}', 'delete')->name('delete');
});


// Auth::routes(['register' => false]); //to make register desabled
Auth::routes(['verify' => true, 'register' => false]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');