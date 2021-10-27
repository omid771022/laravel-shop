<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PaymentRepo;

class DashboardController extends Controller
{

    public $paymentRepo;
    public function __construct(PaymentRepo $paymentRepo)
    {
        $this->paymentRepo = $paymentRepo;
    }
    public function index(){

        $payments = $this->paymentRepo->paymentAll();
        
        return view('Dashboard.index', compact('payments'));
    }
}
