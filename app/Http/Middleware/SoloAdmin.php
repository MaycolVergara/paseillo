<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoloAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Verificamos si el usuario tiene sesión iniciada y su rol es 1 (Admin)
        if (Auth::check() && Auth::user()->rol == 1) {
            // Le abrimos la puerta
            return $next($request);
        }

        // 2. Si es Mozo (rol 2) y quiere entrar a zonas prohibidas,
        // lo regresamos a su área de mesas automáticamente.
        return redirect('/dashboard/mesasView')
            ->with('error', 'Acceso denegado. Solo administradores.');
    }
}
