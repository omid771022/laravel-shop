<?php

namespace App\Repositories;

use App\Order;
use App\Payment;

use App\Gateways\Zarinpal\zarinpal;
use Illuminate\Support\Facades\Redirect;
use App\Gateways\Zarinpal\ZarinpalAdaptor;

class PaymentRepo implements PaymentRepoInterface
{

    public  function generate($amount, $order_id)
    {
        $seller_p = 0;
        $seller_share = 0;
        $site_share = 0;
        $gateway = new ZarinpalAdaptor();
        $invoiceid = $gateway->request($amount);
        if (is_array($invoiceid)) {
        }
          Payment::create([
            'amount' => $amount,
            "invoice_id" => $invoiceid,
            "gateway" => "zarinpal",
            "status" => 'pending',
            "seller_p" => $seller_p,
            "seller_share" => $seller_share,
            "site_share" => $site_share,
            "order_id" => $order_id->id,
        ]);
        $client = new zarinpal();
        $callback = "http://127.0.0.1:8000/test/test";
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
    }
}
