<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoloAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Verificamos si el usuario tiene sesión iniciada y su role_id es 1 (Admin)
        // Cambiamos 'rol' por 'role_id'
        if (Auth::check() && Auth::user()->role_id == 1) {
            // Le abrimos la puerta
            return $next($request);
        }

        // 2. Si es Mozo (role_id 2) y quiere entrar a zonas prohibidas,
        // lo regresamos a su área de mesas (tableView).
        return redirect('/dashboard/tableView')
            ->with('error', 'Access denied. Administrators only.');
    }
}
