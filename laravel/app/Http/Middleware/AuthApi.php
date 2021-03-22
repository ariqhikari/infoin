<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->get('u')) {
            Cookie::queue('u', $request->get('u'), 1440);
            $user = User::where('token', $request->get('u'))->first();
        } elseif (Auth::check()) {
            $user = Auth::user();
        } else {
            $user = User::where('token', $request->cookie('u'))->first();
        }

        if (!$user) {
            return Redirect::to(env('MAIN_DOMAIN') . 'login');
        } else if ($user->email_verified_at == null) {
            return Redirect::to(env('MAIN_DOMAIN') . 'verify-email');
        } else if ($user->blacklist == 1) {
            return Redirect::to(env('MAIN_DOMAIN') . 'blacklist');
        }

        Auth::login($user);
        return $next($request);
    }
}
