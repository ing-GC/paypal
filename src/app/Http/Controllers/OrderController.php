<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ActivityLogHelper;
use App\Services\PayPalService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $paypalClient;

    public function __construct()
    {
        $paypalService = PayPalService::getInstance();
        $this->paypalClient = $paypalService->getPayPalClient();
    }

    public function index()
    {
        return view('orders.create');
    }

    public function create(Request $request)
    {
        $this->paypalClient->getAccessToken();

        $request_to_paypal = now();
        $response = $this->paypalClient->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'MXN',
                        'value' => '100.00'
                    ]
                ]
            ]
        ]);

        ActivityLogHelper::updateLog($request->log_id, [
            'paypal_request_start_at' => $request_to_paypal,
            'paypal_endpoint' => 'v2/checkout/orders',
            'paypal_response_finished_at' => now(),
            'response' => $response
        ]);

        return $response;
    }

    public function capture(Request $request, string $id)
    {
        $this->paypalClient->getAccessToken();

        $request_to_paypal = now();
        $response = $this->paypalClient->capturePaymentOrder($id);

        ActivityLogHelper::updateLog($request->log_id, [
            'paypal_request_start_at' => $request_to_paypal,
            'paypal_endpoint' => 'v2/checkout/orders/{order_id}/capture',
            'paypal_response_finished_at' => now(),
            'response' => $response
        ]);

        return $response;
    }
}
