<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    static $statuses = ['success' => 'تایید', 'canceled' => 'کنسل', 'pending' => 'انتظار' , 'fail'=>' ناموفق' ];
protected $garded = [];
public function order(){
    return $this->belongsTo(Order::class);
}
}
