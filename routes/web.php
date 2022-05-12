<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerjalananController;
use App\Models\Perjalanan;
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



Route::get('/logout', [UserController::class, 'logout']);

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'postlogin']);
    Route::get('/register', [UserController::class, 'register']);
    Route::post('/postregister', [UserController::class, 'postregister']);
});

// Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {
//     Route::get('/card', [DashboardController::class, 'indexSiswa']);

//     Route::get('/search', [DashboardController::class, 'search']);

//     Route::get('/form', [SiswaController::class, 'index']);

//     Route::post('/create', [SiswaController::class, 'create']);

// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/perjalanan', [DashboardController::class, 'indexPerjalanan']);

    Route::post('/perjalanan/simpanperjalanan', [PerjalananController::class, 'create']);

    Route::get('/perjalanan/form', [PerjalananController::class, 'index']);

    Route::get('/perjalanan/cariPerjalanan', [PerjalananController::class, 'cariPerjalanan']);

    Route::get('/perjalanan/sortPerjalanan', [PerjalananController::class, 'sortingPerjalanan']);

    Route::get('/perjalanan/{id}/delete', [PerjalananController::class, 'delete']);

    Route::get('/perjalanan/{perjalanan}/edit', [PerjalananController::class, 'edit']);

    Route::put('/perjalanan/{id}/update', [PerjalananController::class, 'update']);

    Route::get('/master', function() {
        return view('layouts.master');
    });
});


