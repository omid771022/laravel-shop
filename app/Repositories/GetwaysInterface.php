<?php

namespace App\Repositories;

use App\Payment;


interface GetwaysInterface
{
    public function request(Payment $payment);

    public function verify(Payment $payment);
}