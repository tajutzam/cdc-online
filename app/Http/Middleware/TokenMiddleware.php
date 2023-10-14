<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class TokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // handle check token on heaeders
        $token = $request->header('Authorization');
        // dd($token);
        if (Str::startsWith($token, 'Bearer ')) {
            $newToken = Str::after($token, 'Bearer '); // get token without bearer
            $user = User::where('token', $newToken)->first();
            if (isset($user)) {
                $expire = Carbon::parse($user->token_expire);
                if ($expire->lessThan(Carbon::now())) {
                    return response()->json([
                        'status' => false,
                        'message' => 'your token is expired , please login again',
                        'data' => null
                    ], 401, );
                } else {
                    return $next($request);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'your token is not valid , please login again',
                    'data' => null
                ], 401, );
            }
        }

        throw new UnauthorizedException('ops your token is not valid please login');
    }
}