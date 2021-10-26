<?php



namespace App\Gateways\Zarinpal;

use App\Payment;
use App\Gateways\Zarinpal\zarinpal;
use Illuminate\Support\Facades\URL;
use App\Repositories\GetwaysInterface;

class ZarinpalAdaptor  implements GetwaysInterface
{


    private $url;
    private $client;
    public function request($amount)
    {
        $this->client = new zarinpal();
        $callback = "http://127.0.0.1:8000/test/test";
        $result =  $this->client->request("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $amount, "test", "", "", $callback, true);
        if (isset($result["Status"]) && $result["Status"] == 100) {
       
    
             $this->url = $result['StartPay'];
            return $result['Authority'];
        } else {
            return [
                "status" => $result["Status"],
                "message" => $result["Message"]
            ];
        }
    }
//jfsdfsdf
    public function verify(Payment $payment)
    {
        // TODO: Implement verify() method.
    }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }
}
