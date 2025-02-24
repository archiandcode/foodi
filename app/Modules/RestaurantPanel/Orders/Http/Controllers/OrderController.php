<?php

namespace App\Modules\RestaurantPanel\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\RestaurantPanel\Orders\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        Order::query()->with('orderItems')->get();
        return view('panel.restaurant.orders.index');
    }

}
