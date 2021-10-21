<?php
namespace App\Gateways\zarinpal;

use App\Payment;
use App\Repositories\GetwaysInterface;

class ZarinpalAdapter  implements GetwaysInterface{
public function request(Payment $payment){
$zarinpal = new Zarinpal();
$callback="";
$result = $zarinpal->request("***", $payment->amount, $payment->paymentable->title,"","", $callback);
if (isset($result["Status"]) && $result["Status"] == 100)
{
	// Success and redirect to pay
return $result['Authority'];
} else {
	// error
	echo "خطا در ایجاد تراکنش";
	echo "<br />کد خطا : ". $result["Status"];
	echo "<br />تفسیر و علت خطا : ". $result["Message"];
}

}
public function verify(Payment $payment){
    
}
}