<?php

namespace App\Repositories;

use App\Media;
use App\Lesson;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


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



    public function store($request, $id)
    {



        $img = $request->file('lesson_file');
        $imageName = uniqid();
        $extention = $img->extension();
        $fullnameFile = $imageName . '.' . $extention;
        $img->move(storage_path("/uploads/lesson/"), $fullnameFile);


        $media = Media::create([
            'files' => $fullnameFile,
            'type' => $extention,
            "user_id" => auth()->id(),
            "filename" => $imageName,

        ]);
        return Lesson::create([
            "title" => $request->title,
            "slug" => Str::slug($request->slug),
            "time" => $request->time,
            "proiority" => $this->generateNumber($request->number, $id),
            'season_id' => $request->season_id,
            'coures_id' => $id,
            'media_id' => $media->id,
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            'confirmationStatus' => 'pending',
            "status" => 'open'
        ]);
    }
    public function paginate()
    {
        return Lesson::orderBy('proiority')->paginate();
    }

    public function findById($id){
        return Lesson::find($id);
    }
    public function delete($id){
        $lesson = $this->findById($id);

        $media=Media::find($lesson['media_id']);
        if ($media['files']) {
            @unlink(storage_path('/uploads/lesson/') . $media['files']);
            $media->delete();
        }
        DB::table("media")->where('id',$lesson['media_id'])->delete();
        $lesson->delete();




    }
}
