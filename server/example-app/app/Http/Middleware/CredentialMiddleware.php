<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CredentialMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tmp = $request->header("Authorization");
        $token = $tmp ? substr($tmp, 7, strlen($tmp)) : "";

        if (!$token) {
            return response()->json(['message' => 'Invalid Authentication: Token not found'], 400);
        } 

        try {
            // Check token validity
            if (!JWTAuth::parseToken()->check()) {
                return response()->json(['message' => 'Invalid Authentication: Token invalid'], 401);
            }

            // Retrieve the token payload
            //$tokenPayload = JWTAuth::getPayload($token)->toArray();
           // dd($tokenPayload);

            // Attempt to authenticate the user with the provided token
            $user = JWTAuth::authenticate($token);

            // If authentication fails, return unauthorized response
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Attach the authenticated user to the request object
            $request->user = $user;

            return $next($request);
        } catch (JWTException $e) {
            // If an exception occurs during authentication, return error response
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
