<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        $notificaciones = auth()->user()->unreadNotifications;
        //! para mostrar el numero de notificaciones sin leer se hace de la siguiente manera
        /* $numeroNotificaciones = auth()->user()->unreadNotifications->count(); */

        return view('notificaciones.index', [
            'notificaciones' => $notificaciones,
            /* 'numeroNotificaciones' => $numeroNotificaciones, */
        ]);
    }
}
