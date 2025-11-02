<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('last_activity');
            if ($lastActivity && now()->diffInMinutes($lastActivity) >= 1) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', 'Sesi berakhir setelah 5 menit tidak aktif.');
            }
            session(['last_activity' => now()]);
        }

        return $next($request);
    }
}