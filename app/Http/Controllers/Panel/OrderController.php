<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Orders
     *
     * @return Factory|View|\Illuminate\View\View
     */
    public function __invoke()
    {
        return view('orders', [
            'orders' => Order::all()
        ]);
    }
}
