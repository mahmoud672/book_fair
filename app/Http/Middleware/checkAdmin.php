<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkAdmin
{

    public function handle($request, Closure $next)
    {
        if(!Auth::guest()){
            if(Auth::user()->job_type=='admin'){
                return $next($request);
            }else{
                return redirect("/login");
            }
        }else{
            return redirect("/");
        }

    }
}
