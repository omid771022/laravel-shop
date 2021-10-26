<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{

    static $statuses = ['success' => 'تایید', 'canceled' => 'کنسل', 'pending' => 'انتظار' , 'fail'=>' ناموفق' ];
    protected $guarded = [];
public function order(){
    return $this->belongsTo(Order::class);
}



}
