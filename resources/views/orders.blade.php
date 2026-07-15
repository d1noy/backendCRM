@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="page-title">
            <div>
                <h1>Orders</h1>
                <p>View and monitor all customer orders
                </p>
            </div>
        </div>
        <div class="modern-table">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Price</th>
                    <th class="text-end">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{$order->product->name}}</div>
                        </td>
                        <td>
                        <span class="text-muted">{{$order->user->email}}</span>
                        </td>
                        <td>
                        <span class="fw-bold text-success">{{$order->product->price}} ₽</span>
                        </td>
                        <td class="text-end">
                            @if($order->status === 'pending')
                                <span class="status-badge pending"><i class="bi bi-clock-history"></i>Not paid
                            </span>
                            @elseif($order->status === 'success')
                                <span class="status-badge success"><i class="bi bi-check-circle-fill"></i>Success
                            </span>
                            @else
                                <span class="status-badge failed"><i class="bi bi-x-circle-fill"></i>Failed
                            </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
