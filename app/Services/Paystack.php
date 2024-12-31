<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class Paystack
{
    protected static $customer;
    protected static $account;
    protected static $bank;

    public static function customer()
    {
        if (self::$customer === null) {
            self::$customer = new PaystackCustomer();
        }
        return self::$customer;
    }

    public static function account()
    {
        if (self::$account === null) {
            self::$account = new PaystackAccount();
        }
        return self::$account;
    }

    public static function bank()
    {
        if (self::$bank === null) {
            self::$bank = new PaystackBank();
        }
        return self::$bank;
    }

    public function webhook(Request $request)
    {
        $secretKey = env('PAYSTACK_SECRET_KEY');
        $signature = $request->header('X-Paystack-Signature');
        $payload = $request->getContent();

        // Verify webhook signature
        if (!hash_equals($signature, hash_hmac('sha512', $payload, $secretKey))) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $data = $request->input();

        if ($data['event'] == 'charge.success') {
            $accountNumber = $data['data']['metadata']['account_number'] ?? null;

            if ($accountNumber) {
                $wallet = \App\Models\Wallet::where('account_number', $accountNumber)->first();

                if ($wallet && $wallet->user) {
                    $user = $wallet->user;
                    $amount = $data['data']['amount'] / 100; // Convert kobo to naira
                    $reference = $data['data']['reference'];
                    $status = $data['data']['status'];
                    Log::info('Webhook processing started: ' . $data);

                    try {
                        // Use a database transaction
                        DB::transaction(function () use ($wallet, $user, $reference, $amount, $status) {
                            // Create the transaction record
                            \App\Models\Transaction::create([
                                'user_id' => $user->id,
                                'transaction_reference' => $reference,
                                'amount' => $amount,
                                'transaction_type' => 'credit',
                                'description' => 'Deposit from Bank',
                                'processed_at' => now(),
                                'status' => $status,
                            ]);

                            // Update wallet balance
                            $wallet->update([
                                'balance' => $wallet->balance + $amount,
                            ]);
                        });

                        return response()->json(['status' => 'success']);
                    } catch (\Exception $e) {
                        // Log the error for debugging
                        Log::error('Webhook processing failed: ' . $e->getMessage());

                        return response()->json(['error' => 'Failed to process webhook'], 500);
                    }
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

}
