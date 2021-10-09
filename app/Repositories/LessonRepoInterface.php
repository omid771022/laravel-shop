<?php
namespace App\Repositories;

interface LessonRepoInterface {
    public function store($request,$id);
    public function paginate();
    public function delete($id);
    public function findById($id);
    public function deleteMultiple($request);
    public function rjectMultiple($request);
    public function confirmMultiple($request);
    public function accept($id);
    public function reject($id);
    public function pending($id);
    public function lock($id);
    public function open($id);

}