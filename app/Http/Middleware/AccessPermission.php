<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Brian2694\Toastr\Facades\Toastr;


class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->hasAnyRoles(['Admin', 'Author'])) {
            return $next($request);
        }
        Toastr::success('Chỉ có quyền Admin và Author được phép truy cập!');
        return redirect()->back();
    }
}
