<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FileController;
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


Auth::routes();

Route::controller(ClientController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/client/{uuid}', 'show')->name('client');
    Route::get('/edit', 'update')->name('update');
    Route::post('/edit', 'edit');
    Route::post('/delete/{id}', 'delete')->name('delete');
});

Route::post('/upload-file', [FileController::class, 'upload'])->name('upload-file');
Route::post('/assign-file', [FileController::class, 'assignFile'])->name('assign-file');


