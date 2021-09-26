<?php

namespace App;

use App\User;
use App\Media;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    static $types = ['free' => 'رایگان', 'cash' => 'پولی'];
    static $enums = ['completed' => 'کامل شده', 'not-completed' => 'درحال برگزاری', 'lock' => 'فقل شده'];

    protected $fillable = ['teacher_id', 'percent', 'category_id', 'user_id', 'title', 'slug', 'proiority', 'price', 'type', 'enum', 'banner_id', 'body'];
    public function media()
    {
        return $this->belongsTo(Media::class, 'banner_id', 'id');
    }
    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
