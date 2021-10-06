<?php
namespace App\Repositories;

interface LessonRepoInterface {
    public function store($request,$id);
    public function paginate();
    public function delete($id);
    public function findById($id);

}