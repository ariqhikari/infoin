<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Visitor;
use App\User;

class CheckRole
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
        Visitor::create([
            "ip" => $request->ip(),
            "user_id" => Auth::id()
        ]);

        $user = User::where("id", Auth::id())->first();
        $user->update([
            "status" => 1
        ]);

        return $next($request);
    }
}
