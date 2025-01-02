<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Support\Facades\Http;

trait Service
{
    protected string $paystackSecretKey;
    protected string $paystackBaseUrl;
    protected string $paystackEnvironment;
    protected $user;

    protected function initPaystack(): void
    {
        $this->paystackSecretKey = env('PAYSTACK_SECRET_KEY');
        $this->paystackBaseUrl = 'https://api.paystack.co';
        $this->paystackEnvironment = env('PAYSTACK_ENVIRONMENT', 'test');
        $this->user = auth()->user();
    }

    protected function getUrl(string $endpoint)
    {
        return Http::withToken($this->paystackSecretKey)
            ->get($this->paystackBaseUrl . $endpoint);
    }

    protected function postUrl(string $endpoint, array $payload = [])
    {
        return Http::withToken($this->paystackSecretKey)
            ->post($this->paystackBaseUrl . $endpoint, $payload);
    }

    protected function putUrl(string $endpoint, array $payload = [])
    {
        return Http::withToken($this->paystackSecretKey)
            ->put($this->paystackBaseUrl . $endpoint, $payload);
    }

    protected function deleteUrl(string $endpoint, array $payload = [])
    {
        return Http::withToken($this->paystackSecretKey)
            ->delete($this->paystackBaseUrl . $endpoint, $payload);
    }

    protected function wallet()
    {
        $wallet = Wallet::where('user_id', auth()->user()->id)->first();
        if (!$wallet) {
            $wallet = new Wallet();
            $wallet->user_id = auth()->user()->id;
            $wallet->save();
        }
        return $wallet;
    }
}
