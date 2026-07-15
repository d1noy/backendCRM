@extends('layout')

@section('content')
    <section class="container">
        <div class="d-flex flex-column justify-content-center form-container">
            <div class="card shadow pay-card">
                <div class="card-body">
                    <div class="pay-badge">
                        <span>🔒</span> Тестовая оплата
                    </div>

                    <h2 class="text-center mb-2 fs-1">Оплата заказа</h2>
                    <p class="text-center pay-order-id">#{{ $payment->order_id }}</p>

                    <div class="pay-amount">
                        <span class="pay-amount-label">К оплате</span>
                        <span class="pay-amount-value">{{ number_format($payment->price, 2, ',', ' ') }} ₽</span>
                    </div>

                    @error('card')
                    <div class="alert alert-danger fs-2" id="errorMessage">
                        {{ $message }}
                    </div>
                    @enderror

                    <form method="POST" action="{{ route('payments.mock-pay-submit', $payment->order_id) }}" id="payForm">
                        @csrf

                        <div class="mb-4">
                            <label for="card_number" class="form-label fs-2">Номер карты</label>
                            <input
                                type="text"
                                class="form-control fs-2"
                                id="card_number"
                                name="card_number"
                                placeholder="0000 0000 0000 0000"
                                value="4242 4242 4242 4242"
                                maxlength="19"
                                inputmode="numeric"
                                autocomplete="cc-number"
                            >
                        </div>

                        <div class="d-flex gap-3 mb-4">
                            <div class="flex-fill">
                                <label for="card_expiry" class="form-label fs-2">Срок действия</label>
                                <input
                                    type="text"
                                    class="form-control fs-2"
                                    id="card_expiry"
                                    name="card_expiry"
                                    placeholder="ММ/ГГ"
                                    value="12/29"
                                    maxlength="5"
                                    inputmode="numeric"
                                    autocomplete="cc-exp"
                                >
                            </div>
                            <div class="flex-fill">
                                <label for="card_cvc" class="form-label fs-2">CVC</label>
                                <input
                                    type="text"
                                    class="form-control fs-2"
                                    id="card_cvc"
                                    name="card_cvc"
                                    placeholder="000"
                                    value="123"
                                    maxlength="3"
                                    inputmode="numeric"
                                    autocomplete="cc-csc"
                                >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 my-2 fs-2" id="payBtn">
                            Оплатить {{ number_format($payment->price, 2, ',', ' ') }} ₽
                        </button>

                        <p class="pay-hint">Это тестовая форма, реальное списание не производится</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('card_number').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '').slice(0, 16);
            e.target.value = value.replace(/(.{4})/g, '$1 ').trim();
        });

        document.getElementById('card_expiry').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '').slice(0, 4);
            if (value.length >= 3) {
                value = value.slice(0, 2) + '/' + value.slice(2);
            }
            e.target.value = value;
        });

        document.getElementById('card_cvc').addEventListener('input', function (e) {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 3);
        });

        document.getElementById('payForm').addEventListener('submit', function () {
            const btn = document.getElementById('payBtn');
            btn.disabled = true;
            btn.textContent = 'Обработка платежа...';
        });
    </script>
@endsection
