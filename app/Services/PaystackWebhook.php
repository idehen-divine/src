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

    public function handle($request)
    {
        $signature = $request->header('X-Paystack-Signature');
        $payload = $request->getContent();

        if (!hash_equals($signature, hash_hmac('sha512', $payload, $this->paystackSecretKey))) {
            Log::error('Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $data = $request->input();
        switch ($data['event']) {
            case 'charge.success':
                $this->charge($data);
                break;

            case 'transfer.success':
                $this->transferSuccess($data);
                break;

            case 'transfer.failed' || 'transfer.reversed':
                $this->transferFailed($data);
                break;

            default:
                Log::info('Unhandled event type: ' . $data['event']);
        }
    }

    public function charge($data)
    {
        $accountNumber = $data['data']['metadata']['receiver_account_number'] ?? null;

        if ($accountNumber) {
            $wallet = Wallet::where('account_number', $accountNumber)->first();

            if ($wallet && $wallet->user) {
                $user = $wallet->user;
                $amount = $data['data']['amount'] / 100;
                $reference = $data['data']['reference'];

                try {
                    DB::transaction(function () use ($wallet, $user, $reference, $amount) {
                        Transaction::create([
                            'user_id' => $user->id,
                            'transaction_reference' => 'trx_' . $reference,
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

        return response()->json(['status' => 'success']);
    }

    public function transferSuccess($data)
    {
        Log::info('Webhook data', $data['data']);
        $reference = $data['data']['reference'];
        $transaction = Transaction::where('transaction_reference', $reference)->first();
        if ($transaction) {
            $transaction->status = 'successful';
            $transaction->processed_at = now();
            $transaction->save();
        }
        return response()->json(['status' => 'success']);
    }

    public function transferFailed($data)
    {
        $reference = $data['data']['reference'];
        $transaction = Transaction::where('transaction_reference', $reference)->first();
        if ($transaction) {
            DB::beginTransaction();
            $transaction->status = 'failed';
            $transaction->processed_at = now();
            $transaction->save();
            $user = $transaction->user;
            $user->wallet->balance += $transaction->amount;
            $user->wallet->save();
            DB::commit();
        }
        return response()->json(['status' => 'success']);
    }
}
