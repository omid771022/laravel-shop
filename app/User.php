<?php

namespace App;

use App\Order;
use App\Course;
use App\Notifications\VerifyMail;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
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

    static $statues = ['active' => 'فعال', 'inactive' => 'غیر فعال', 'ban' => 'بلاک'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shaba', 'card_number', 'name', 'email', 'password', 'mobile', 'image', 'username', 'headline', 'bio', 'website', 'linkedin', 'tiwitter', 'telgram', 'status'
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

    public function  image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }

    public function profilePath()
    {
        return $this->username ? route('viewProfile', $this->username) : route('viewProfile', 'username');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }



    public function hasAccessToCourse($course)
    {

        $auth = Auth::user()->id;
        if ($this->can('admin' || 'super admin' ||  $this->id == $course->teacher_id) || $course->students->contains($this->id)) {
            return true;
        } else {
            return false;
        }
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function studentsCount()
    {
        //todo
        return 0;
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
