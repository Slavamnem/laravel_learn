<?php

namespace App\Http\Middleware;

use Closure;

class Mymiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $param = null)
    {
        echo $param;
        echo "middle worked";
        //echo "<pre>"; print_r($request); echo "</pre>";
        if($request->route('id') > 5){
            echo $request->route('id');
        }
        else{
            //return redirect()->route("Editor");
        }
        return $next($request);
    }
}
