<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticatedToDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            return match ($role) {
                'admin' => redirect('/admin'),
                'doctor' => redirect('/admin/dokter'),
                'nurse' => redirect('/admin/nurse'),
                'user' => redirect('/users'),
                default => redirect('/'),
            };
        }

        return $next($request); // kalau belum login, silakan lanjut akses '/'
    }
}
