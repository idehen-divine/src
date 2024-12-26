<?php

namespace App\Services;

class PaystackAccount
{
    use Service;

    public function __construct()
    {
        $this->initPaystack();
    }

    public function all(int $perPage = 50, int $page = 1)
    {
        $response = $this->getUrl('/dedicated_account', [
            'perPage' => $perPage,
            'page' => $page,
        ]);
        return $response->json();
    }

    public function get(string $accountId = null)
    {
        $accountId = $accountId ?? $this->wallet()->account_id;
        $response = $this->getUrl("/dedicated_account/{$accountId}");
        return $response->json();
    }

    public function create(array $data = null)
    {
        $wallet = $this->wallet();
        if (!$wallet->customer_code) {
            $customerResponse = Paystack::customer()->create();
            if (!$customerResponse['status'] === true) {
                return $customerResponse;
            }
        }

        if ($wallet->account_id) {
            $old = $this->getUrl("/dedicated_account/{$wallet->account_id}");
            if($old->json()['data']['assigned'] === false){
                $response = $this->postUrl('/dedicated_account', $data ?? [
                    'customer' => $wallet->customer_code,
                    'preferred_bank' => $this->paystackEnvironment == 'test' ? 'test-bank' : 'wema-bank',
                ]);
            }else{
                $response = $old;
            }

        } else {
            $response = $this->postUrl('/dedicated_account', $data ?? [
                'customer' => $wallet->customer_code,
                'preferred_bank' => $this->paystackEnvironment == 'test' ? 'test-bank' : 'wema-bank',
            ]);
        }


        $data = $response->json();

        if ($response->successful() && isset($data['data'])) {
            $accountData = $data['data'];
            $wallet->fill([
                'account_id' => $accountData['id'],
                'account_number' => $accountData['account_number'],
                'account_name' => $accountData['account_name'],
                'bank_name' => $accountData['bank']['name'],
            ])->save();
        }

        return $data;
    }

    public function requery(string $bank = null, string $accountNumber = null)
    {
        $accountNumber = $accountNumber ?? $this->wallet()->account_number;
        $bank = $bank ?? str_replace(' ', '-', strtolower($this->wallet()->bank_name));
        $response = $this->getUrl("/dedicated_account/requery?account_number={$accountNumber}&provider_slug={$bank}");
        return $response->json();
    }

    public function delete(string $accountId = null)
    {
        $accountId = $accountId ?? $this->wallet()->account_id;
        $response = $this->deleteUrl("/dedicated_account/{$accountId}");
        return $response->json();
    }
}
