<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;

class JwtVerifier
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
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token not provided.'], 401);
        }

        try {
            $secret = env('JWT_SECRET');
            
            if (!$secret) {
                throw new Exception('JWT_SECRET is not configured in .env');
            }

            // Decode the token using HS256 algorithm
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));

            // Create a virtual user object from the JWT payload
            $user = new User();
            $user->id = $decoded->sub;
            $user->name = $decoded->name ?? null;
            
            // Convert roles array to a collection of objects to match Eloquent relationships
            if (isset($decoded->roles)) {
                $roles = collect($decoded->roles)->map(function ($role) {
                    $roleObj = new \stdClass();
                    $roleObj->name = $role->name;
                    $roleObj->permissions = collect($role->permissions)->map(function ($perm) {
                        $permObj = new \stdClass();
                        $permObj->name = $perm;
                        return $permObj;
                    });
                    return $roleObj;
                });
                $user->setRelation('roles', $roles);
            }

            if (isset($decoded->applications)) {
                $user->applications = $decoded->applications;
            }

            // Authenticate the virtual user for this request
            Auth::setUser($user);

        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Invalid token or server error.',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 401);
        }

        return $next($request);
    }
}
