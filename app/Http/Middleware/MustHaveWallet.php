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

        if (!$user->wallet->account_number) {
            try {
                $this->paystack->customer()->create();
                $this->paystack->account()->create();
            } catch (\Exception $e) {
                Log::error('Error creating customer or account: ' . $e->getMessage());
                return abort(500, 'An Error Occurred. Please try reloading the page.');
            }
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
