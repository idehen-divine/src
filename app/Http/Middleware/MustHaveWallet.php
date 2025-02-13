<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Paystack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class MustHaveWallet
{
    protected $paystack;

    /**
     * Constructor to inject the Paystack service.
     */
    public function __construct(Paystack $paystack)
    {
        $this->paystack = $paystack;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user->wallet->account_number && auth()->user()->role !== 'ADMIN') {
            return redirect()->route('wallet')->withErrors(['wallet' => 'Please set up your wallet account first.']);
        }

        return $next($request);
    }
}
