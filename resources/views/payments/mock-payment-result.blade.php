@extends('layout')

@section('content')
<section class="container">
    <div class="d-flex flex-column justify-content-center form-container">
        <div class="card shadow pay-card">
            <div class="card-body text-center">
                @if ($payment->status === 'success')
                <div class="pay-result-icon pay-result-success">✓</div>
                <h2 class="fs-1 mb-2">Оплата прошла успешно</h2>
                <p class="pay-order-id">#{{ $payment->order_id }}</p>
                <p class="pay-amount-value">{{ number_format($payment->price, 2, ',', ' ') }} ₽</p>
                @else
                <div class="pay-result-icon pay-result-failed">✕</div>
                <h2 class="fs-1 mb-2">Оплата отклонена</h2>
                <p class="pay-order-id">#{{ $payment->order_id }}</p>
                <p class="pay-hint">Проверьте данные карты и попробуйте снова</p>

                <a href="{{ route('payments.mock-pay-form', $payment->order_id) }}" class="btn btn-primary w-100 my-2 fs-2">
                    Попробовать снова
                </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
