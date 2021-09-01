<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function getParentAttribute()
    {
        return (!$this->parent_id) ? 'ندارند' : $this->parentCategory->name;
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function subCategory()
    {
        $this->hasMany(Category::class, 'parent_Id');
    }
}
