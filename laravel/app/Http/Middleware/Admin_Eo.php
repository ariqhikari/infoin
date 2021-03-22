<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin_Eo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id < 2) {
            return redirect()->back()->with("error", "Anda Tidak Memilika Hak Akses");
        }
        return $next($request);
    }
}
