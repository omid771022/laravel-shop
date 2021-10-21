<?php

namespace App;

use App\User;
use App\Course;
use App\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['status','user_id', 'price'];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class,'courses_orders', 'order_id', 'course_id');
    }
    public function payments(){
        return $this->belongsToMany(Payment::class);
    }
}
