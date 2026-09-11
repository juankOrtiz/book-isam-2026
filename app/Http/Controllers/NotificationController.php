<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function __invoke(string $id)
    {
        // 1. Encontrar la notificacion por su id
        $notificacion = DatabaseNotification::find($id);
        // 2. Marcar la notificacion como leida
        $notificacion->markAsRead();
        // 3. Redirigir a donde gustemos
        return back();
    }
}
