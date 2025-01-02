<?php

namespace App\Console\Commands;

use App\Services\Paystack;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ConfirmPendingTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:cofirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Confirm pending transactions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch transactions with 'processing' status
        $transactions = Transaction::where('status', 'processing')->get();

        foreach ($transactions as $transaction) {
            try {
                $status = Paystack::transfer()->verify($transaction->transaction_reference)['data']['status'];
                if ($status === 'success') {
                    $transaction->update(['status' => 'successful']);
                    Log::info("Transaction {$transaction->id} marked as completed.");
                } else {
                    $transaction->update(['status' => 'failed']);
                    Log::info("Transaction {$transaction->id} marked as failed.");
                }
            } catch (\Exception $e) {
                Log::error("Error processing transaction {$transaction->id}: " . $e->getMessage());
            }
        }
    }
}
