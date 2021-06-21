<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Role extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if(Auth::check()){

            if (count($roles) > 1) {
                // echo $user['role'];
                foreach ($roles as $key => $role) {
                    if ($user['role']==$role) {
                        return $next($request);
                    }
                }
            } else {
                if ($user['role']==$roles[0]) {
                    return $next($request);
                }
            }
            return response()->json("you don't have permission", 400);

        }else{
            return response()->json("can't access page", 500);
        }
    }

}
