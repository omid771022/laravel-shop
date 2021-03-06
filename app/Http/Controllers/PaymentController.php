<?php

namespace App\Http\Controllers;

use App\Order;
use App\Payment;
use App\Helper\Cart\Cart;
use Illuminate\Http\Request;
use App\Repositories\PaymentRepo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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


    public function verify(Request $request)
    {
        $Authority = $this->paymentRepo->getInvoiceByInvoiceId($request);
        $payment = $this->paymentRepo->findBYInvoiceId($Authority);
        $paymentResult = $this->paymentRepo->verify($payment);

        if (is_array($paymentResult)) {
            $status = "fail";
            $this->paymentRepo->changeStatus($payment, $status);
            Session::flash('message', "کاربر گرامی تراکنش ناموفق بود ");
            return redirect("/home");
        } else {
            $status = "success";
            $this->paymentRepo->changeStatus($payment, $status);
            Session::flash('message', "کاربر گرامی تراکنش باموفقیت صورت گرفت ");
            return redirect("/home");
        }
    }



    public function transaction(Request $request){

        $payments = $this->paymentRepo->search($request->email ,$request->endDate, $request->startDate)->paginate(20);
   
        $getLastTotalDays = $this->paymentRepo->getLastTotalDays();
        $getLastNetIncome =$this->paymentRepo->getLastNetIncome();
        $getAllSeller = $this->paymentRepo->getAllSeller();
        $getAllNetIncome = $this->paymentRepo->getAllNetIncome();
        return view('Dashboard.Payment.transaction', compact(['payments','getLastTotalDays','getLastNetIncome','getAllSeller','getAllNetIncome']));

    }


    public function purchase(){
          $user= Auth::user();
          $orders=$user->orders;



        return view('Dashboard.Payment.purchase', compact('orders'));
    }
}
