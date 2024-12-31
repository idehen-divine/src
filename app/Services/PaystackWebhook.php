<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaystackWebhook
{
    use Service;

    public function __construct()
    {
        $this->initPaystack();
    }

    public function charge($request)
    {
        $signature = $request->header('X-Paystack-Signature');
        $payload = $request->getContent();
        
        if (!hash_equals($signature, hash_hmac('sha512', $payload, $this->paystackSecretKey))) {
            Log::error('Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $data = $request->input();

        if ($data['event'] == 'charge.success') {
            $accountNumber = $data['data']['metadata']['receiver_account_number'] ?? null;

            if ($accountNumber) {
                $wallet = Wallet::where('account_number', $accountNumber)->first();

                if ($wallet && $wallet->user) {
                    $user = $wallet->user;
                    $amount = $data['data']['amount'] / 100; // Convert kobo to naira
                    $reference = $data['data']['reference'];
                    $status = $data['data']['status'];

                    try {
                        DB::transaction(function () use ($wallet, $user, $reference, $amount, $status) {
                            // Create the transaction record
                            Transaction::create([
                                'user_id' => $user->id,
                                'transaction_reference' => $reference,
                                'amount' => $amount,
                                'transaction_type' => 'credit',
                                'description' => 'Deposit from Bank',
                                'processed_at' => now(),
                                'status' => 'successful',
                            ]);

                            $wallet->balance = $wallet->balance + $amount;
                            $wallet->save();
                        });

                        return response()->json(['status' => 'success']);
                    } catch (\Exception $e) {
                        Log::error('Webhook processing failed: ' . $e->getMessage());

                        return response()->json(['error' => 'Failed to process webhook'], 500);
                    }
                }
            }
        }

        return response()->json(['status' => 'success']);
    }
}