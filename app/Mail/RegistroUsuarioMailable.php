<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroUsuarioMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    /**
     * Crea una nueva instancia del mailable.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Construye el mensaje.
     */
    public function build()
    {
        return $this->view('emails.plantilla')
                    ->subject('¡Bienvenido a nuestra plataforma!')
                    ->with(['name' => $this->name]);
    }
}

