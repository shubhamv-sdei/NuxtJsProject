<?php

namespace App\Http\Middleware;

use Closure;

class TokenVerify
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
        if ($request->input('token') != '0xff51afd7ed558ccdL') {
            return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Token Expired']);
        }
        return $next($request);
    }
}
