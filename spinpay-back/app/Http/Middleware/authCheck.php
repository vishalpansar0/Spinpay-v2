<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authCheck
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
        if($request->session()->has('user_id')){
            if($request->session()->has('role') == 4){
                return redirect('/user/borrower');
            }else if($request->session()->has('role') == 3){
                return redirect('/user/lender');
            }
        }
        return $next($request);
    }
}
