<?php
namespace App\Repositories;

interface PaymentRepoInterface {
    public static function generate($amount, $paymentable, $buyer_id);
    // public function request(Payment $payment);
    // public function verify(Payment $payment);
}