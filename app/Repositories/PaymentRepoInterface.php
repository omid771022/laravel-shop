<?php
namespace App\Repositories;

interface PaymentRepoInterface {
    public  function generate($amount, $order_id);
    // public function request(Payment $payment);
    // public function verify(Payment $payment);
}