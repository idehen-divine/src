<?php

namespace App\Livewire\User\Wallet;

use App\Models\Wallet as UserWallet;
use Livewire\Component;
use App\Services\Paystack;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Wallet extends Component
{
    public $wallet;
    public $bank;
    public $showModal = false;
    public $showWithdrawalModal = false;
    public $banks;
    public $account_number;
    public $account_name;
    public $bank_code;
    public $bank_name;
    public $amount;

    public function showingModal()
    {
        $this->showModal = true;
        $this->account_name = null;
        $this->bank_name = null;
        $this->account_number = null;
        $this->bank_code = null;
    }

    public function showingWithdrawalModal()
    {
        $this->showWithdrawalModal = true;
        $this->amount = null;
    }

    public function updatedAccountNumber()
    {
        $this->account_name = null;
        $this->bank_name = null;

        if (strlen($this->account_number) === 10) {
            $this->bank_name = collect($this->banks)->firstWhere('code', $this->bank_code)['name'];
            $accountDetails = Paystack::bank()->resolve($this->account_number, $this->bank_code)['data'];
            $this->account_name = $accountDetails['account_name'];
        }
    }

    public function updateBank()
    {
        if ($this->bank) {
            auth()->user()->bank->account_name = $this->account_name;
            auth()->user()->bank->account_number = $this->account_number;
            auth()->user()->bank->bank_name = $this->bank_name;
            auth()->user()->bank->bank_code = $this->bank_code;
            auth()->user()->bank->save();
        } else {
            auth()->user()->bank()->create([
                'account_name' => $this->account_name,
                'account_number' => $this->account_number,
                'bank_name' => $this->bank_name,
                'bank_code' => $this->bank_code,
            ]);
        }

        $this->showModal = false;
        $this->boot();
        $this->dispatch('notification', [
            'message' => 'Local bank details updated successfully.',
            'type' => 'success',
        ]);
    }

    public function withdraw()
    {
        $validator = Validator::make([
            'amount' => $this->amount,
        ], [
            'amount' => 'required|numeric|min:1000|max:' . $this->wallet->balance,
        ], [
            'amount.min' => 'The minimum withdrawal amount is ₦1,000.',
            'amount.max' => 'Insufficient funds!. You cannot withdraw more than your wallet balance.',
        ]);

        if ($validator->fails()) {
            $this->showWithdrawalModal = false;
            $this->dispatch('triggerToast', $validator->errors()->all());
            return;
        }

        DB::beginTransaction();
        try {
            UserWallet::deduct($this->amount);
            DB::commit();
            $this->dispatch('notification', [
                'message' => 'Withdrawal request placed successfully.',
                'type' => 'success',
            ]);
        } catch (\Exception $th) {
            DB::rollBack();
            $this->dispatch('notification', [
                'message' => 'An error occured during withdrawal request. Please try again',
                'type' => 'error',
            ]);
        }

        $this->showWithdrawalModal = false;
        $this->dispatch('refresh');
        $this->boot();
    }

    public function boot()
    {
        $this->wallet = auth()->user()->wallet;
        $this->bank = auth()->user()->bank;
    }

    public function mount()
    {
        $this->banks = Paystack::bank()->all()['data'];
    }

    public function render()
    {
        return view('user.wallet.wallet');
    }
}