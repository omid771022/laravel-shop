<?php

namespace App\Http\Controllers;

use App\Order;
use App\Helper\Cart\Cart;
use App\Repositories\PaymentRepo;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public $paymentRepo;
    public function __construct(PaymentRepo $paymentRepo)
    {
        $this->paymentRepo = $paymentRepo;
    }
    public function payment()
    {
      
        $price = Cart::all()->sum('price');
        $order = Order::create([
            'status' => 'unpaid',
            'price' => $price,
            'user_id' => auth()->user()->id,
        ]);


        foreach (Cart::all() as  $cart) {
            $carts = $cart['Course']->id;
            $order->courses()->attach($carts);
        }

        $amount = $order['price'];
        $order_id = $order;
        $this->paymentRepo->generate($amount, $order_id);
    }
}
