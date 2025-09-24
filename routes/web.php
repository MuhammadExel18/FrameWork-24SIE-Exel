<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasiswaController;
Route::get('/', function () {
    return view('welcome');
})->name('mahasiswa.show');
Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});
Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);
Route::get('/nama/{param1?}', function ($param1) {
    return 'Nama saya: Exel '.$param1;
});
Route::get('/nim/{param1?/{$nim}', function ($param1 = '',$nim= '')  {
    return 'NIM saya: 2457301090 '.$param1;
});
Route::get('/about', function () {
    return view('halaman-about');
});




