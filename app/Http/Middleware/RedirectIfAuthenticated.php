<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                // Si c'est un admin, on ne redirige pas
                if ($user->role === 'admin') {
                    // Laisser passer la requête, donc le formulaire de login s'affichera toujours
                    return $next($request);
                }

                // Pour les autres utilisateurs, redirection habituelle
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
