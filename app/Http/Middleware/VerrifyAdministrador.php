<?php

namespace App\Http\Middleware;

use App\Traits\Utils;
use Closure;
use Illuminate\Support\Facades\Auth;

class VerrifyAdministrador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    use Utils;

    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->rol == 'administrador')
            return $next($request);

        return $this->returnErrorMessage('Solo los administradores pueden realizar este proceso');
    }
}
