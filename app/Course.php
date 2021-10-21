<?php

namespace App;

use App\User;
use App\Media;
use App\Order;
use App\Lesson;
use App\Repositories\CouresRepo;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    static $types = ['free' => 'رایگان', 'cash' => 'پولی'];
    static $enums = ['completed' => 'کامل شده', 'not-completed' => 'درحال برگزاری', 'lock' => 'فقل شده'];
    static $confirmationStatus = ['accepted' => 'تایید', 'rejected' => 'رد کردن', 'pending' => 'انتظار'];
    protected $fillable = ['teacher_id', 'percent', 'category_id', 'user_id', 'title', 'slug', 'proiority', 'price', 'type', 'enum', 'banner_id', 'body'];
    public function media()
    {
        return $this->belongsTo(Media::class, 'banner_id', 'id');
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }


    public function lessons(){
        return $this->hasMany(Lesson::class,'coures_id');

    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getDuration()
    {
        return (new CouresRepo())->getDuration($this->id);
    }

    public function formattedDuration()
    {
        $duration =  $this->getDuration();
        $h  =round($duration / 60) < 10 ? '0' .  round($duration / 60) :  round($duration / 60);
        $m = ($duration % 60) < 10 ? '0' . ($duration % 60) : ($duration % 60);
        return $h . ':' . $m . ":00";
    }
    public function getFormattedPrice()
    {
        return number_format($this->price);
    }

    public function getDiscount(){
        //todo
        return 0;
    }
    public function getDiscountAmount(){
        //todo
        return 0;
    }
    public function getFinalPrice(){
        return $this->price; - $this->getDiscountAmount();
    }

    public function getFormattedFinalPrice(){
        return number_format($this->getFinalPrice());
    }
    public function lessonsCount(){
      return (new CouresRepo())->getLessonsCount($this->id);
    }
    public function path()
    { 
        return route('single.course', $this->id . '-' . $this->slug);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }
public function orders(){
    return $this->belongsToMany(Order::class , 'courses_orders', 'course_id', 'order_id');
}
}
