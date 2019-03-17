<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        $response = $next($request);

        if ($_ENV['APP_ENV'] != "testing") {
            header("Access-Control-Allow-Origin: *");
            $headers = [
                'Access-Control-Allow-Methods'=> '*',
                'Access-Control-Allow-Headers'=> '*'
            ];
            
            foreach($headers as $key => $value) {
                $response->header($key, $value);
            }
        }
        return $response;
    }
}
