<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;

Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.reportes_vista');
Route::get('/reportes/export', [ReporteController::class, 'exportExcel'])->name('reportes.export');
Route::get('/reportes/select', [ReporteController::class, 'selectReport'])->name('reportes.selectSingle');
Route::get('/reportes/export', [ReporteController::class, 'exportSingle'])->name('reportes.exportSingle');


Route::resource('productos', ProductoController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/enviar-correo', [EmailController::class, 'showForm'])->name('emails.formulario');
Route::post('/enviar-correo', [EmailController::class, 'enviarCorreo'])->name('emails.enviar');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
})->name('login');

