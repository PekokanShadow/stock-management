<?php

// app/Http/Middleware/CheckPermissions.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermissions
{
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $user = auth()->username();

        // Allow if admin or if user has all required permissions
        if ($user->role === 'admin' || $user->hasPermissions($permissions)) {
            return $next($request);
        }

        abort(403, 'Anda bukan admin');
    }
}
