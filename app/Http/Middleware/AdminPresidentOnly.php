<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminPresidentOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();
        $role = $user->role()->first()->role_name;
        
        if($user && ($role === 'admin' || $role === 'president')){
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
