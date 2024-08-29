<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userToken = $request->header('Authorization');

        if(!$userToken) {
            return response()->json([
                'message' => 'Token tidak tersedia'
            ], 401);
        }

        $user = User::where('userToken', $userToken)->first();

        if(!$user) {
            return response()->json([
                'message' => 'Token tidak valid'
            ], 401);
        }

        $request->attributes->set('user', $user);

        return $next($request);
    }
}
