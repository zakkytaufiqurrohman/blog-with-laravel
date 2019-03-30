<?php

namespace App\Http\Middleware;
// use App\User;
use Closure;
use Auth;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$ok)
    {
        if(is_array($ok)){
            foreach($ok as $ko){
                if(Auth::user()->role==$ko){
                    return $next($request);
                }
                
            }
            // return abort(401,'Unauthorized');
            return abort(401, 'Unauthorized');
        }
       
        
    }
}
