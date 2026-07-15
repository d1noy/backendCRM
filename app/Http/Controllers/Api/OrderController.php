<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Get user orders
     *
     * @return AnonymousResourceCollection
     */
   public function index(): AnonymousResourceCollection
   {
       return OrderResource::collection(auth()->user()->orders);
   }


    /**
     * Create order
     *
     * @param Product $product
     * @return array|JsonResponse
     */
    public function store(Product $product)
    {
        $order = auth()->user()->orders()->create([
            'product_id' => $product->id,
        ]);

        try {
            $payment = app(MockPaymentController::class)
                ->createPayment($product->price, route('payment-webhook'));

            $order->pay_url = $payment['pay_url'];
            $order->order_id = $payment['order_id'];
            $order->save();
        } catch (\Throwable $th) {
            report($th);
            return response()->json(['error' => $th->getMessage()], 500);
        }

        return ['pay_url' => $order->pay_url];
    }
}
