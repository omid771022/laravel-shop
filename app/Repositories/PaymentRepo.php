<?php

namespace App\Repositories;

use App\User;
use App\Order;
use App\Payment;
use App\Helper\Cart\Cart;
use App\Events\PaymentSuccessEvent;
use App\Gateways\Zarinpal\zarinpal;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class PaymentRepo implements PaymentRepoInterface
{

private $query;
public function __construct(){
    $this->query = Payment::latest()->get();
}

    public function search($email ,$endDate, $startDate)
    {
     
          if(!is_null($email) && is_null($endDate) && is_null($startDate)){
              $users=User::where('email',"like", "%". $email ."%")->get();
              if(!is_null($users)){
               $payments=[];
                foreach($users as $user){
                   foreach($user->orders as $order){

                    $payments[] = $order->payments;
                   }
                
              }
              return $payments;
    }
              else{
       
            }

        }
elseif(is_null($email) && !is_null($endDate) && !is_null($startDate)){
 
    $start= Jalalian::fromFormat('Y/m/d', $startDate)->toCarbon();
    $end = Jalalian::fromFormat('Y/m/d', $endDate)->toCarbon();
  
   return  Payment::whereBetween('created_at', [$start, $end]);

}
          

        return Payment::latest();
        
        }
    public function paymentAll()
    {
        return Payment::latest()->paginate(10);
    }

    public function findBYInvoiceId($invoiceid)
    {
        return payment::where('invoice_id', $invoiceid)->first();
    }

    public  function generate($amount, $order_id)
    {
        $i = 0;
        $x = 0;
        foreach ($order_id->courses as $payment_course) {
            $itemsTitle[]  =  $payment_course->title;
            $itemsPercent[]  = $i += ($payment_course->price / 100) * $payment_course->percent;
            $itemsPercent[] = $x +=  $payment_course->price - ($payment_course->price / 100) * $payment_course->percent;
        }
        $percent = array_slice($itemsPercent, -2);

        $seller_share = 0;
        $site_share = 0;

        $title = implode(",", $itemsTitle);
        if (!is_null($percent)) {
            $seller_share  = $percent[0];
            $site_share = $percent[1];
        } else {
            $percent = 0;
            $seller_share = 0;
            $site_share = 0;
        }
        $client = new zarinpal();
        $callback = route('payment.verfy');
        $result =  $client->request("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $amount, $title, "", "", $callback, true);

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
            "seller_p" => $percent[0],
            "seller_share" => $seller_share,
            "site_share" => $site_share,
            "order_id" => $order_id->id,
        ]);
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
            $order_id = $payment['order_id'];
            $order = Order::find($order_id);
            foreach ($order->courses as $value) {
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


    public function getLastTotalDays()
    {
        return payment::where("created_at", ">=", now()->addDays(-30))->where('status', 'success')->sum('amount');
    }

    public function getLastNetIncome()
    {
        return payment::where("created_at", ">=", now()->addDays(-30))->where('status', 'success')->sum('site_share');
    }
    public function getAllSeller()
    {
        return payment::where("status", "success")->sum('amount');
    }
    public function getAllNetIncome()
    {
        return payment::where('status', 'success')->sum('site_share');
    }

    public function purchase(){
     
    }
}
