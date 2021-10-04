<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    static $confirmationStatus = ['accepted' => 'تایید', 'rejected' => 'رد کردن', 'pending' => 'انتظار'];
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
public function user(){
    return $this->belongsTo(User::class);
}

}
