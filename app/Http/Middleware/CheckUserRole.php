<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()){
            return redirect('login');
        }
        $userRole = auth()->user()->role;
        $allowedRoles = explode('|', $role);
        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Akses Dibatasi. Anda tidak memiliki role yang memadai.');
        }
        return $next($request);
    }
}
