<?php

namespace App\Http\Middleware;
use Closure;
use Session;
use Auth;
class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        // dd("permissions");
        

        $permission_str     = Auth::user()->permissions;
        $permissions        =  explode(",",$permission_str);

        // dd($permissions);

        // ---------- for owner / super admin 
        if(in_array('all', $permissions)){
            return $next($request);
        }
        // end 


        
        $this_request = $request->route()->getName();

        if(in_array($this_request, $permissions)){
            return $next($request);
        }else{


            if($request->ajax()){
                    return response()->json([
                        'message' => "Have no permission"
                    ]);
            }else{
                return back()->with('success','Have no permission');
            }

        }

        


      

        
        
    }
}
