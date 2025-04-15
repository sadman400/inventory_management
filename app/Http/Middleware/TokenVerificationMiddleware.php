<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        $verify = JWTToken::verify_token($token);
        if ($verify == 'unauthorized') {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized',
            ], 401);
        } else {
            $request->headers->set('email', $verify->email);
            if (isset($verify->id)) {
                $request->headers->set('id', $verify->id);
            }
            return $next($request);
        }
    }
}
