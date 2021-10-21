<?php
namespace App\Repositories;
use App\Payment;
interface GetwaysInterface
{
    public function request($amount);
    public function verify(Payment $payment);
    public function redirect();
}