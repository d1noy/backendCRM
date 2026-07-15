<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WebhookController extends Controller
{
    public function handleInternal(string $orderId, string $status): void
    {
        $order = Order::where('order_id', $orderId)->first();

        if ($order) {
            $order->status = $status;
            $order->save();
        }
    }

    public function handle(Request $request)
    {
        $this->handleInternal($request->order_id, $request->status);

        return response()->json(['ok' => true]);
    }
}

