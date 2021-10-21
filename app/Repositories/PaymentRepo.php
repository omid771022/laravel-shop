<?php

namespace App\Repositories;

use App\Payment;

class PaymentRepo implements PaymentRepoInterface
{
    public static function generate($amount, $paymentable, $buyer_id)
    {
        $gateway = "";
        if ($amount <= 0 || is_null($paymentable->id) || is_null($buyer_id)) {
            return false;
        }
        if (is_null($paymentable->percent)) {
            $sller_p = $paymentable->percent;
            $seller_share = ($amount / 100) * $sller_p;
            $site_share = $amount - $seller_share;
        } else {
            $seller_p = 0;
            $seller_share = 0;
            $site_share = 0;
        }


        $invoiceid = 0;
        return Payment::create([
            'buyer_id' => $buyer_id->id,
            'paymentable' => $paymentable->id,
            'payment_type' => get_class($paymentable),
            'amount' => $amount,
            "invoice_id" => $invoiceid,
            "gateway" => $gateway,
            "status" => 'pending',
            "seller_p" => $seller_p,
            "seller_share" => $seller_share,
            "site_share" => $site_share,
        ]);
    }
}
