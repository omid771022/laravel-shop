<?php
namespace App\Repositories;

use App\Payment;

interface PaymentRepoInterface {
    public  function generate($amount, $order_id);
    public function findBYInvoiceId($invoiceid);
    public function verify($payment);
    public function changeStatus($payment, $status);
    public function paymentAll();
    public function getLastTotalDays();
    public function getLastNetIncome();
    public function getAllSeller();
    public function getAllNetIncome();
    public function search($email ,$endDate, $startDate);
}