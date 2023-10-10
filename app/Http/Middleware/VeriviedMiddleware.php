<?php

namespace App\Http\Middleware;

use App\Exceptions\ForbiddenException;
use App\Services\UserService;
use Closure;
use Illuminate\Http\Request;

class VeriviedMiddleware
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
        $userService = new UserService();

        
        $verivied = $userService->checkUserStatus($request->bearerToken());

        if ($verivied) {
            return $next($request);
        }
        throw new ForbiddenException('ops , nampaknya akun kamu belum terverifikasi');
    }


}