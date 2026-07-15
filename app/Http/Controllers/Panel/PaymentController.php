<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    private const SUCCESS_CARD = '4242424242424242';
    private const DECLINED_CARDS = [
        '4000000000000002', // generic decline
        '4000000000009995', // insufficient funds
    ];
    public function showForm(Payment $payment)
    {
        if ($payment->status === 'success') {
            return view('payments.mock-payment-result', ['payment' => $payment]);
        }

        return view('payments.mock-payment', ['payment' => $payment]);
    }

    public function pay(PaymentRequest $request, Payment $payment)
    {
        $cardNumber = preg_replace('/\D/', '', $request->input('card_number'));
        $status = $this->resolveStatus($cardNumber, $request->card_expiry);
        $payment->update(['status' => $status]);
            app(WebhookController::class)->handleInternal($payment->order_id, $status);


        if ($status === 'failed') {
            $payment->update(['status' => 'pending']); // разрешаем повторить попытку

            return redirect()
                ->route('payments.mock-pay-form', $payment->order_id)
                ->withErrors(['card' => 'Карта отклонена. Проверьте номер, срок действия или используйте другую карту.']);
        }

        return view('payments.mock-payment-result', ['payment' => $payment]);
    }

    private function resolveStatus(string $cardNumber, string $expiry)
    {
        if(preg_match('/^(\d{2})\/(\d{2})$/', $expiry, $m)) {
            $expMonth = (int)$m[1];
            $expYear = 2000 + (int)$m[2];
            if ($expYear < now()->year || ($expYear === now()->year && $expMonth < now()->month)) {
                return 'failed';
            }
        }else{
                return 'failed';// некорректный формат срока
            }
            if(in_array($cardNumber, self::DECLINED_CARDS, true)) {
                return 'failed';
            }
        if ($cardNumber === self::SUCCESS_CARD) {
        return 'success';
    }

        // любая другая карта — тоже "не найдена"/отклонена
        return 'failed';
    }

}
