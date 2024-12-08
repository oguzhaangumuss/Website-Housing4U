<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Kullanıcının rolünü kontrol et
        if ($user && $user->hasRole($role)) {
            return $next($request);
        }

        // Yetkisiz erişim
        return abort(403, 'Bu alana erişim yetkiniz yok.');
    }
}