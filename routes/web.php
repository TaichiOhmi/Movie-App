<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;

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

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MoviesController::class, 'show'])->name('movies.show');

Auth::routes();
// Route::group(['middleware'=>'auth'],function(){
//     Route::get('/', 'contents.index');
//     Route::view('/show', 'contents.show');
//     Route::get('/', [HomeController::class, 'index'])->name('index');

//     Route::get('/movie/show', [HomeController::class, 'show'])->name('show');

//     Route::get('/TVshow/show', [])
// });