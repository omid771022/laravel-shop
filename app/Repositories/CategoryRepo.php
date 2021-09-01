<?php
namespace App\Repositories;

use App\Category;


class CategoryRepo{
public function all(){
    return Category::all();
}

public function store($value){
  return  Category::create([
        'name' => $value->name,
        'slug' => $value->slug,
        'parent_id' => $value->parent_id,
    ]);
}

public function findById($value){
 return Category::where('id', $value)->first();
}


public function updateCategory($value, $id){
    return  Category::where('id', $id)->update([
        'name' => $value->name,
        'slug' => $value->slug,
        'parent_id' => $value->parent_id,
    ]);
}

public function deleteCategory($id){
    Category::where('id', $id)->delete();
}

}

?>