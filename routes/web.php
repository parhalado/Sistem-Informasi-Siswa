<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;

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
});

Route::get('/siswa',[SiswaController::class ,'index'])->name('index');
Route::post('/siswa/create', [SiswaController::class, 'create'])->name('create');
Route::get('/siswa/{id}/edit',[SiswaController::class,'edit'])->name('edit');
Route::post('/siswa/{id}/update', [SiswaController::class, 'update'])->name('update');
Route::get('/siswa/{id}/delete',[SiswaController::class,'delete'])->name('delete');