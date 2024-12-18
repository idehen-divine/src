<?php

namespace App\Livewire\User\Wallet;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Wallet extends Component
{
    use WithFileUploads;

    public $balance;
    public $details;

    public $amount;
    public $photo;

    public $bank;
    public $withdrawal_amount;
    public $account_name;
    public $account_number;

    public function deposit()
    {
        $this->validate([
            'amount' => 'required|numeric|min:100',
            'photo' => 'required|image|max:1024',
        ]);

        $photo = $this->photo->store('deposit_photos', 'public');
        Storage::disk('local')->deleteDirectory('livewire-tmp');

        helpers()->getAuthUser()->transactions()->create([
            'reference' => Str::uuid(),
            'amount' => $this->amount,
            'type' => 'credit',
            'status' => 'pending',
            'description' => 'Bank deposit',
            'photo_path' => $photo,
        ]);

        $this->amount = null;
        $this->photo = null;

        $this->dispatch('notification', [
            'message' => 'Deposit created successfully!',
            'type' => 'success',
        ]);

        return redirect()->route('user.history');
    }

    public function withdraw()
    {
        $this->validate([
            'bank' => 'required',
            'account_name' => 'required',
            'account_number' => 'required',
            'withdrawal_amount' => 'required|numeric|min:100',
        ]);

        helpers()->getAuthUser()->transactions()->create([
            'reference' => Str::uuid(),
            'amount' => $this->withdrawal_amount,
            'type' => 'debit',
            'status' => 'pending',
            'description' => "Withdrawal request : Amount: {$this->withdrawal_amount}, Bank: {$this->bank}, Account Name: {$this->account_name}, Account Number: {$this->account_number}",
        ]);

        $this->dispatch('notification', [
            'message' => 'Withdrawal request created successfully!',
            'type' => 'success',
        ]);

        return redirect()->route('user.history');
    }

    public function boot()
    {
        $this->balance = auth()->user()->balance;
        $this->details = new \stdClass();
        $this->details->account_name = settings()->getValue('app_account_name', 'Account Name');
        $this->details->account_number = settings()->getValue('app_account_number', 'Account Number');
        $this->details->bank = settings()->getValue('app_bank', 'Bank');
    }

    public function render()
    {
        return view('user.wallet.wallet');
    }
}
