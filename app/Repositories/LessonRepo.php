<?php

namespace App\Repositories;

use App\Media;
use App\Lesson;

use Illuminate\Support\Str;


class LessonRepo implements LessonRepoInterface
{




    public function generateNumber($number, $courseId): int
    {
        $courseRepo = new CouresRepo();
        if (is_null($number)) {
            $proiority = $courseRepo->findByid($courseId)->lessons()->orderBy('proiority', 'desc')->firstOrNew([])->proiority ?: 0;
            $proiority++;
        }
        return $number;
    }
    


    public function store($request, $id){


   
        $img = $request->file('lesson_file');
        $imageName = uniqid();
        $extention = $img->extension();
        $fullnameFile = $imageName . '.' . $extention;
        $img->move(storage_path("/uploads/lesson/"), $fullnameFile);

        $media = Media::create([
            'files' => $fullnameFile,
            'type' => "video",
            "user_id" => auth()->id(),
            "filename" => $imageName,

        ]);
        return Lesson::create([
            "title" => $request->title,
            "slug" => Str::slug($request->slug), 
            "time" => $request->time,
            "proiority" => $this->generateNumber($request->number, $id), // todo generate automatic number
            'season_id' => $request->season_id,
            'coures_id' => $id,
            'media_id' => $media->id,
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            'confirmationStatus' => 'pending',
            "status"=> 'open'
        ]);

}
public function paginate()
{
    return Lesson::orderBy('proiority')->paginate();
}








}
