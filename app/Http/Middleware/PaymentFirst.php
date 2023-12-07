<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaymentFirst
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
     
        $buktiPath = session('bukti_path');
        $bank = session('bank');
        if (!isset($buktiPath) || !isset($bank)) {
            return redirect("/company/apply")->withErrors('Harap pilih pembayaran dan bukti transfer terlebih dahulu');
        }
        return $next($request);
    }
}
