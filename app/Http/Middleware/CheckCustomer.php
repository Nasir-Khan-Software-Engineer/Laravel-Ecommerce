<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
class CheckCustomer
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

        $user_type = Auth::user()->type;
       

        if($user_type == 'customer'){
            return $next($request);
        }else{
            return redirect('/');
        }
       
    }
}
