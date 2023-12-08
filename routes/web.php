<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;

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
    return view('home');
});



Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/postlogin',[AuthController::class,'postlogin'])->name('postlogin');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');


// routes dengan role admin
Route::group(['middleware' => ['auth','checkRole:admin']], function()
{
    
    Route::get('/siswa',[SiswaController::class ,'index'])->name('index');
    Route::post('/siswa/create', [SiswaController::class, 'create'])->name('create');
    Route::get('/siswa/{siswa}/edit',[SiswaController::class,'edit'])->name('edit');
    Route::post('/siswa/{siswa}/update', [SiswaController::class, 'update'])->name('update');
    Route::get('/siswa/{siswa}/delete',[SiswaController::class,'delete'])->name('delete');
    Route::get('/siswa/{siswa}/profile',[SiswaController::class,'profile'])->name('profile');
    Route::post('siswa/{id}/addnilai',[SiswaController::class,'addnilai'])->name('addnilai');
    Route::get('/siswa/{id}/{idmapel}/deletenilai',[SiswaController::class,'deletenilai'])->name('deletenilai');
     Route::get('siswa/export/', [SiswaController::class, 'export'])->name('export');  // Export Excel
    Route::get('siswa/exportpdf/', [SiswaController::class, 'exportpdf'])->name('exportpdf');
    Route::get('guru/{id}/profile',[GuruController::class,'profile'])->name('profile');


});
// routes dengan role siswa dan admin
Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
});