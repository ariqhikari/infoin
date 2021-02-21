<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Eo
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
        if(Auth::user()->role_id != 2){
            return redirect()->back()->with("error","Anda Tidak Memilika Hak Akses");
        }
        return $next($request);
    }
}
