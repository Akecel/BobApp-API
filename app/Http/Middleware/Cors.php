<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

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

        if (!App::environment('testing')) {
            header("Access-Control-Allow-Origin: *");
            $headers = [
                'Access-Control-Allow-Methods'=> '*',
                'Access-Control-Allow-Headers'=> 'Content-Type', 'Accept', 'Authorization','*'
            ];
            
            foreach($headers as $key => $value) {
                $response->header($key, $value);
            }
        }
        return $response;
    }
}
