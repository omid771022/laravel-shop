<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    static $types = ['free'=>'رایگان', 'cash'=> 'پولی'];
    static $enums = ['completed'=> 'کامل شده','not-completed'=>'درحال برگزاری', 'lock'=>'فقل شده'];

    protected $fillable =['teacher_id','category_id', 'user_id', 'title', 'slug', 'proiority', 'price', 'type', 'enum', 'banner_id'];

}
