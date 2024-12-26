<?php

namespace App\Services;

class PaystackCustomer
{
    use Service;

    public function __construct()
    {
        $this->initPaystack();
    }

    public function all(int $perPage = 50, int $page = 1)
    {
        $response = $this->getUrl('/customer', [
            'perPage' => $perPage,
            'page' => $page,
        ]);
        return $response->json();
    }

    public function get(string $customerCode = null)
    {
        $customerCode = $customerCode ?? $this->wallet()->customer_code;
        $response = $this->getUrl("/customer/{$customerCode}");
        return $response->json();
    }

    public function create(array $data = null)
    {
        if ($this->wallet()->customer_code) {
            $response = $this->getUrl("/customer/{$this->wallet()->customer_code}");
        } else {
            $response = $this->postUrl('/customer', $data ?? [
                'email' => $this->user->email,
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'phone' => '+234' . $this->user->phone,
            ]);
        }

        $data = $response->json();

        if ($response->successful()) {
            $this->wallet();
            $this->wallet()->fill([
                'customer_id' => $data['data']['id'],
                'customer_code' => $data['data']['customer_code'],
            ])->save();
        }

        return $data;
    }

    public function update(array $data = null)
    {
        $customerCode = $this->wallet()->customer_code;
        $response = $this->postUrl("/customer/{$customerCode}", $data ?? [
            'email' => $this->user->email,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'phone' => '+234' . $this->user->phone,
        ]);

        $data = $response->json();

        if ($response->successful()) {
            return [
                'success' => true,
                'message' => 'Customer updated successfully!',
                'data' => $data['data'],
            ];
        }

        return [
            'success' => false,
            'message' => $data['message'] ?? 'Failed to update customer.',
        ];
    }
}
