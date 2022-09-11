<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthMiddle
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
        // echo '<pre>';
        // $val = $request->cookie('access_token');
        // var_dump($val);
        // abort(403);

        $response = auth('api')->check();
        $responseCode = 200;
        if(!$response) {
            try {   
               if (!app(\Tymon\JWTAuth\JWTAuth::class)->parseToken()->authenticate()) {
               $response = 0;
               }
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
               $response = $e;
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
               $response = -2;
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
               $response = -3;
            }
        } else {
            $response = (int) $response;
        }
        return response()->json($response, $responseCode);
    }
}
