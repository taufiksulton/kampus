<?php

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
    return view('front');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/prodi', 'App\Http\Controllers\ProdiController');
Route::resource('/mata_kuliah', 'App\Http\Controllers\MataKuliahController');
Route::resource('/dosen', 'App\Http\Controllers\DosenController');
Route::resource('/mahasiswa', 'App\Http\Controllers\MahasiswaController');
