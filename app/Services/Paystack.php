<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

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
}
