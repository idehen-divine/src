<?php

namespace App\Services;

class PaystackBank
{
    use Service;

    public function __construct()
    {
        $this->initPaystack();
    }

    public function all()
    {
        $response = $this->getUrl('/bank');
        return $response->json();
    }

    public function resolve($account_number, $bank_code)
    {
        $response = $this->getUrl("/bank/resolve?account_number=$account_number&bank_code=$bank_code");
        return $response->json();
    }

    public function resolveBin($bin)
    {
        $response = $this->getUrl("/decision/bin/$bin");
        return $response->json();
    }
}