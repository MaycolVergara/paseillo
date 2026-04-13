<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            // Si no está autenticado, redirigir al login
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al dashboard.');
        }

        // Verificar que el usuario tenga una sesión válida
        if (!Auth::user()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Sesión inválida. Por favor, inicia sesión nuevamente.');
        }

        // Log de acceso para auditoría
        \Log::info('Dashboard access', [
            'user_id' => Auth::id(),
            'username' => Auth::user()->username,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'route' => $request->route()->getName() ?? $request->path(),
            'timestamp' => now()
        ]);

        return $next($request);
    }
}