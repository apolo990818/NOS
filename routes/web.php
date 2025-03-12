<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/enviar-correo', [EmailController::class, 'showForm'])->name('emails.formulario');
Route::post('/enviar-correo', [EmailController::class, 'enviarCorreo'])->name('emails.enviar');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');