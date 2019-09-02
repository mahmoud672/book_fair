<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class checkReader
{

    public function handle($request, Closure $next)
    {
        if(!Auth::guest()){
            $user=auth()->user();
            $type=$user->job_type;
            if($type=='reader'){
                return $next($request);
            }else{
                return redirect("/login");
            }
        }else{
            return redirect("/");
        }
    }
}
