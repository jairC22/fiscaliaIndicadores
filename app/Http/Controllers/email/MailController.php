<?php

namespace App\Http\Controllers\email;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\notificacion;
use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{
    //

    public function enviarCorreo()
    {
        $destinatario = 'prueba@correo.com'; // Cambia esto por el destinatario
        $nombre = 'Usuario de Prueba';

        try {
            Mail::to($destinatario)->send(new notificacion($nombre));
            return response()->json(['message' => 'Correo enviado con éxito.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
