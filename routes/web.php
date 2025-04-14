<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/simpan', [App\Http\Controllers\HomeController::class, 'simpan'])->name('simpan');
Route::put('/edit/{idtugas}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');
Route::get('/hapus/{id}', [App\Http\Controllers\HomeController::class, 'hapus'])->name('hapus');
