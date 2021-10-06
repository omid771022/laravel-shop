<?php

namespace App;

use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    static $confirmationStatus = ['accepted' => 'تایید', 'rejected' => 'رد کردن', 'pending' => 'انتظار'];
    static $statuses = [ 'open' => 'باز است ','lock' => 'فقل است'];
    protected $guarded = [];
    public function  season(){
        return $this->belongsTo(Season::class);
    }


    public function course(){
        return $this->belongsTo(Course::class);

    }
public function user(){
    return $this->belongsTo(User::class);
}
public function media(){
    return $this->belongsTo(Media::class);
}

}