<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BuyerAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('userid')) {
            return redirect()->route('buyer.login');
        }

        return $next($request);
    }
}
