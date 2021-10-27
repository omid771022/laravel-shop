<?php
namespace App\Repositories;

use App\Payment;

interface PaymentRepoInterface {
    public  function generate($amount, $order_id);
    public function findBYInvoiceId($invoiceid);
    public function verify($payment);
    public function changeStatus($payment, $status);
    public function paymentAll();
}