<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ChatController;

// Registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('register', [RegisterController::class, 'register']);

// Rutas protegidas con autenticación
Route::middleware(['auth'])->group(function () {

    // Reportes
    Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.reportes_vista');
    Route::get('/reportes/select', [ReporteController::class, 'selectReport'])->name('reportes.selectSingle');
    Route::get('/reportes/export', [ReporteController::class, 'exportSingle'])->name('reportes.exportSingle');

    // Rutas admin (prefijo /admin y auth)
    Route::prefix('admin')->group(function () {

        // Lista de chats (usuarios)
        Route::get('/chat', [ChatController::class, 'index'])->name('admin.chat.index');

        // Mostrar chat con usuario específico
        Route::get('/chat/{usuario}', [ChatController::class, 'show'])->name('admin.chat.show');

        // Obtener mensajes nuevos vía AJAX
        Route::get('/chat/{usuario}/messages', [ChatController::class, 'getMessages'])->name('admin.chat.getMessages');

        // Enviar mensaje vía AJAX
        Route::post('/chat/{usuario}/send', [ChatController::class, 'sendMessage'])->name('admin.chat.sendMessage');
    });

    // Recursos productos
    Route::resource('productos', ProductoController::class);
});

// Rutas de autenticación (login, logout, reset, etc)
Auth::routes();

// Página principal después del login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas para enviar correos
Route::get('/enviar-correo', [EmailController::class, 'showForm'])->name('emails.formulario');
Route::post('/enviar-correo', [EmailController::class, 'enviarCorreo'])->name('emails.enviar');

// Página de login (vista)
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return view('auth.login');
})->name('login');
