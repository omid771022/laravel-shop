<?php

namespace App\Repositories;

use App\Media;
use App\Course;
use Illuminate\Support\Str;
use App\Repositories\CouresRepoInterface;


class CouresRepo implements CouresRepoInterface
{


    public static function keyCourse()
    {
        return array_keys(\App\Course::$confirmationStatus);
    }

    public function storeCoures($request)
    {

        $img = $request->file('image');

        $imageName = uniqid();
        $extention = $img->extension();
        $fullnameFile = $imageName . '.' . $extention;
        $img->move(public_path("/uploads/course/"), $fullnameFile);

        $media = Media::create([
            'files' => $fullnameFile,
            'type' => "image",
            "user_id" => auth()->id(),
            "filename" => $imageName,

        ]);

        return Course::create([
            'teacher_id' => $request->teacher_id,
            'category_id' => $request->category_id,
            'banner_id' => $media['id'],
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'proiority' => $request->priority,
            'price' => $request->price,
            'percent' => $request->percent,
            'type' => $request->typeBuy,
            'enum' => $request->statusEnum,
            'body' => $request->body,
        ]);
    }

    public function paginate()
    {
        return Course::paginate();
    }
    public function delete($id)
    {
        $course = Course::where('id', $id)->first();

        if ($course->media) {
            @unlink(public_path('/uploads/course/') . $course->media->files);
            $course->media->delete();
            $course->delete();
        }
        return back();
    }
    public function findById($id)
    {
        return Course::find($id);
    }

    public function updateStatus($id)
    {
        $key = $this->keyCourse();
        return Course::where('id', $id)->update([
            'confirmationStatus' => $key[0],
        ]);
    }
    public function updateStatusPending($id)
    {
        $key = $this->keyCourse();

        return Course::where('id', $id)->update([
            'confirmationStatus' => $key[2],
        ]);
    }
    public function updateStatusRejected($id)
    {
        $key = $this->keyCourse();
        return Course::where('id', $id)->update([
            'confirmationStatus' => $key[1],
        ]);
    }

    
}
