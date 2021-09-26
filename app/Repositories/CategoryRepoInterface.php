<?php

namespace App\Repositories;

interface CategoryRepoInterface{
public function store($value);
public function findById($value);
public function updateCategory($value, $id);
public function deleteCategory($id);
public function all();
}
