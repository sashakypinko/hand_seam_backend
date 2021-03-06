<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application')
            ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
    }
}
