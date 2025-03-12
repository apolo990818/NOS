<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\RegistroUsuarioMailable;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Muestra el formulario para enviar el correo.
     */
    public function showForm()
    {
        return view('emails.formulario');
    }

    /**
     * Envía el correo basado en los datos proporcionados.
     */
    public function enviarCorreo(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
        ]);

        $correo = new RegistroUsuarioMailable($request->name);
        Mail::to($request->email)->send($correo);

        return back()->with('success', 'Correo enviado exitosamente a ' . $request->email);
    }
}
