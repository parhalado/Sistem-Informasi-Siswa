<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

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
    Route::get('/siswa/{id}/edit',[SiswaController::class,'edit'])->name('edit');
    Route::post('/siswa/{id}/update', [SiswaController::class, 'update'])->name('update');
    Route::get('/siswa/{id}/delete',[SiswaController::class,'delete'])->name('delete');
    Route::get('/siswa/{id}/profile',[SiswaController::class,'profile'])->name('profile');

});
// routes dengan role siswa dan admin
Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function()
{
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
});