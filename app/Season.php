<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    static $confirmationStatus = ['accepted' => 'تایید', 'rejected' => 'رد کردن'];
    static $statuses = [ 'open' => 'باز است ','lock' => 'فقل است'];
    protected $guarded = [];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
public function user(){
    return $this->belongsTo(User::class);
}

}
