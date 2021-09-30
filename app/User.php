<?php

namespace App;

use App\Notifications\VerifyMail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResatPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyMail as NotificationsVerifyMail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    static $statues =['active' => 'فعال','inactive'=>'غیر فعال' ,'ban'=>'بلاک' ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'image', 'username', 'headline', 'bio', 'website', 'linkedin', 'tiwitter', 'telgram', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sendEmailVerificationNotification()
    {

        $this->notify(new VerifyMail());
    }


    public function sendResetPasswordRequestNotification()
    {

        $this->notify(new ResatPasswordNotification());
    }

public function  image(){
    return $this->belongsTo(Media::class, 'image_id');
}



}
