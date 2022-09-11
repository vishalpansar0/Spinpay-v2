<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAgentLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('agent_id')){
            return redirect('/agent/signin')->with('failed','login required!');
        }else{ 
            if($request->session()->get('agent_role')!=2){
                return redirect('/agent/signin')->with('failed','you are not an authorized user for this action!');
            }
        }
        return $next($request);
    }
}
