<?php

namespace App\Services;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalService
{
    private static $instance;
    private $paypalClient;

    private function __construct()
    {
        $this->paypalClient = new PayPalClient();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getPayPalClient()
    {
        return $this->paypalClient;
    }
}