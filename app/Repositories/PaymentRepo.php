<?php

namespace App\Repositories;

use App\Events\PaymentSuccessEvent;
use App\Order;
use App\Payment;
use App\Helper\Cart\Cart;
use App\Gateways\Zarinpal\zarinpal;
use Illuminate\Support\Facades\Auth;
use App\Events\PaymentWasSuccessfull;



class PaymentRepo implements PaymentRepoInterface
{

    public function findBYInvoiceId($invoiceid)
    {
        return payment::where('invoice_id', $invoiceid)->first();
    }

    public  function generate($amount, $order_id)
    {
        $seller_p = 0;
        $seller_share = 0;
        $site_share = 0;
        $client = new zarinpal();
        $callback = route('payment.verfy');
        $result =  $client->request("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $amount, "test", "", "", $callback, true);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            $url = $result['StartPay'];

            redirect()->to($url)->send();
        } else {
            return [
                "status" => $result["Status"],
                "message" => $result["Message"]
            ];
        }
        if (is_array($result['Authority'])) {
            dd($result);
        }
        Payment::create([
            'amount' => $amount,
            "invoice_id" => $result['Authority'],
            "gateway" => "zarinpal",
            "status" => 'pending',
            "seller_p" => $seller_p,
            "seller_share" => $seller_share,
            "site_share" => $site_share,
            "order_id" => $order_id->id,
        ]);

        //  قسمت   title  رو درست کن 
    }


    public function verify($payment)
    {


        if (is_null($payment)) {
            return false;
        }
        $client = new zarinpal();

        $result =  $client->verify("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $payment->amount, true);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            // Success
            return $result["RefID"];
        } else {
            //error
            return [
                "status" =>  $result["Status"],
                "message" => $result["Message"],
            ];
        }
    }

    public function getInvoiceByInvoiceId($request)
    {

        return $request->Authority;
    }

    public function changeStatus($payment, $status)
    {
        $this->findBYInvoiceId($payment['invoice_id'])->update([
            'status' => $status,
        ]);


        if ($status == "success") {
            $payment->order->update([
                'status' => 'paid',
            ]);
            Cart::flush();
       $user =  Auth::user();
        $order_id= $payment['order_id'];      
        $order= Order::find($order_id);
        foreach($order->courses as $value) {
        $user->purchases()->attach($value['id']);
        }

         event(new PaymentSuccessEvent($user));


}
        if ($status == "fail") {
            $payment->order->update([
                'status' => 'cancel',
            ]);
        }
      
}
    }


