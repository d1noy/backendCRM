<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MockPaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MockPaymentController extends Controller
{

    public function store(MockPaymentRequest $request)
    {
        $payment = Payment::create([
            'order_id'=> (string) Str::uuid(),
            'price' => $request->validated('price'),
            'webhook_url' => $request->validated('webhook_url'),
        ]);
        return response()->json([
           'pay_url' => route('payments.mock-pay-form', $payment->order_id),
            'order_id' => $payment->order_id,
        ]);

    }

    public function createPayment(float $price, string $webhookUrl): array
    {
        $payment = Payment::create([
            'order_id' => (string) \Illuminate\Support\Str::uuid(),
            'price' => $price,
            'webhook_url' => $webhookUrl,
        ]);

        return [
            'pay_url' => route('payments.mock-pay-form', $payment->order_id),
            'order_id' => $payment->order_id,
        ];
    }
}
