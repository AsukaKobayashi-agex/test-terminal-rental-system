<?php

namespace MyCommon\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpHeaderControl
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->header('Cache-Control', 'private');
        return $response;
    }
}