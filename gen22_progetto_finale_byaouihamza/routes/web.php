<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\EnsureNameIsHamzaAdmin;
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
    return view('pagina-1');
});


Auth::routes();



Route::get('/home', function () {
    return view('pagina-1');
});

Route::get('/index', function () {
    return view('index');
})->name('index')->middleware(EnsureNameIsHamzaAdmin::class);

Route::resource(
    'products',
    App\Http\Controllers\ProductController::class
);
    

