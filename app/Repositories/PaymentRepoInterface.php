<?php
namespace App\Repositories;

interface PaymentRepoInterface {
    public static function generate($amount, $paymentable, $buyer_id);
}