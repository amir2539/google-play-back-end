<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RawData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $raw = json_decode($request->getContent(), true);

        if (json_last_error() == JSON_ERROR_NONE) {
            $request->replace($raw);
        }

        return $next($request);
    }
}
