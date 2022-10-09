<?php

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
    return view('welcome');
})->middleware('guest');

Auth::routes();
Route::group(['middleware'=>'auth'],function(){

Route::get('/home', [App\Http\Controllers\AlbumController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\AlbumController::class,'store'])->name('addalbume');
Route::post('/images', [App\Http\Controllers\PictureController::class,'store'])->name('addimage');
Route::post('/update/{album}', [App\Http\Controllers\AlbumController::class,'update'])->name('edite');
Route::post('/delete/{album}', [App\Http\Controllers\AlbumController::class,'destroy'])->name('deletealbume');
});
