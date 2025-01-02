<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Paystack
{
    protected static $customer;
    protected static $account;
    protected static $bank;
    protected static $transfer;
    protected static $webhook;

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

    public static function transfer()
    {
        if (self::$transfer === null) {
            self::$transfer = new PaystackTransfer();
        }
        return self::$transfer;
    }

    public static function webhook()
    {
        if (self::$webhook === null) {
            self::$webhook = new PaystackWebhook();
        }
        return self::$webhook;
    }
}
