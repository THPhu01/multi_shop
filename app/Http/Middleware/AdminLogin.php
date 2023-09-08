<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()) {
                return $next($request);
                // } else if (Auth::user()->role == 1) {
                //     $request->session()->invalidate();
                //     $request->session()->regenerateToken();
                //     return redirect()->route('admin.viewLogin')->with('msg', 'Chỉ có quản trị viên được phép truy cập !');
                // }
            }
        }
        return redirect()->route('admin.viewLogin')->with('msg', 'Bạn cần phần phải đăng nhập !');
    }
}
