<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ Gunakan facade agar Intelephense tidak error
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminOrSuperadmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'superadmin'])) {
            abort(403, 'Akses ditolak. Hanya admin dan superadmin yang diizinkan.');
        }

        return $next($request);
    }
}