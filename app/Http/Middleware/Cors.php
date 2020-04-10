<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    public function handle($request, Closure $next)
    {
        $origin = config()->offsetGet('constants.origin') ?? '*';
        return $next($request)
            ->header('Access-Control-Allow-Origin', $origin)
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS, HEAD')
            ->header('Access-Control-Allow-Headers',
                'Content-Type, Authorization, Origin, X-Auth-Token, Accept, X-Requested-With, Accept-encoding')
            ->header('Access-Control-Expose-Headers', '*, Authorization')
            ->header('Access-Control-Allow-Credentials', true);
    }
}

;
