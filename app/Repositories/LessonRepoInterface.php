<?php
namespace App\Repositories;

interface LessonRepoInterface {
    public function store($request,$id);
    public function paginate($id);
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
    public function acceptAll($id);
    public function getaceptedCourse($id);
    public function getFirstLesson($id);
    public function getLesson( $courseId, $lessonId);
    public function getAcceptedLessons($courseId);

}