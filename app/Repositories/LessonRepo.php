<?php

namespace App\Repositories;

use App\Media;
use App\Lesson;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class LessonRepo implements LessonRepoInterface
{
    public static function keyCourse()
    {
        return array_keys(\App\Lesson::$confirmationStatus);
    }




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
        if ($extention == "mp4" || "mp3") {
            $extention = "video";
        }

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
    public function paginate($id)
    {
        return Lesson::where('coures_id', $id)->orderBy('proiority')->paginate();
    }

    public function findById($id)
    {
        return Lesson::find($id);
    }
    public function delete($id)
    {
        $lesson = $this->findById($id);

        $media = Media::find($lesson['media_id']);
        if ($media['files']) {
            @unlink(storage_path('/uploads/lesson/') . $media['files']);
            $media->delete();
        }
        DB::table("media")->where('id', $lesson['media_id'])->delete();
        $lesson->delete();
    }



    public function deleteMultiple($request)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $id) {
            $lessons = Lesson::find($id);
            $medias = $lessons->media->files;
            if ($lessons->media->files) {
                @unlink(storage_path('/uploads/lesson/') . $medias);
            }
            $lessons->media->delete();
            $lessons->delete();
        }
    }

    public function rjectMultiple($request)
    {
        $key = $this->keyCourse();
        $ids = explode(',', $request->ids);
        DB::table('lessons')->whereIn('id', $ids)->update(array(
            'confirmationStatus' => $key[1],
        ));
    }

    public function acceptAll($id)
    {
        $key = $this->keyCourse();
         DB::table('lessons')->where('coures_id', $id)->update(array(
            'confirmationStatus' => $key[0],
        ));
    }


    public function confirmMultiple($request)
    {
        $key = $this->keyCourse();
        $ids = explode(',', $request->ids);
        DB::table('lessons')->whereIn('id', $ids)->update(array(
            'confirmationStatus' => $key[0],
        ));
    }

    public function accept($id)
    {
        $key = $this->keyCourse();
        return Lesson::where('id', $id)->update([
            'confirmationStatus' => $key[0],
        ]);
    }
    public function reject($id)
    {
        $key = $this->keyCourse();
        return Lesson::where('id', $id)->update([
            'confirmationStatus' => $key[1],
        ]);
    }
    public function pending($id)
    {
        $key = $this->keyCourse();
        return Lesson::where('id', $id)->update([
            'confirmationStatus' => $key[1],
        ]);
    }

    public function lock($id)
    {
        return Lesson::where('id', $id)->update([
            'status' => 'lock',
        ]);
    }
    public function open($id)
    {
        return Lesson::where('id', $id)->update([
            'status' => 'open',
        ]);
    }
}
