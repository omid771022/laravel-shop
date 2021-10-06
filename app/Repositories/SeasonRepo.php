<?php

namespace App\Repositories;

use App\Course;
use App\Season;

class SeasonRepo implements SeasonRepoInterface
{
    public function findByIdSeasons($id)

    {
        return Season::find($id);
    }

    public function store($request, $id)
    {
        $course = Course::find($id);
        if (is_null($request->number)) {
            $number =  $course->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        } else {
            $number = $request->number;
        }

        return Season::create([
            'title' =>  $request->title,
            'number' => $number,
            'confirmation_status' => 'pending',
            'course_id' => $id,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function update($request, $id)
    {
        Season::where('id', $id)->update([
            'title' => $request->title,
            'number' => $request->number,
        ]);
    }

    public static function keyCourse()
    {
        return array_keys(\App\Season::$confirmationStatus);
    }
    public function updateStatus($id)
    {
        $key = $this->keyCourse();
        return Season::where('id', $id)->update([
            'confirmation_status' => $key[0],
        ]);
    }
    public function updateStatusPending($id)
    {
        $key = $this->keyCourse();

        return Season::where('id', $id)->update([
            'confirmation_status' => $key[2],
        ]);
    }
    public function updateStatusRejected($id)
    {
        $key = $this->keyCourse();
        return Season::where('id', $id)->update([
            'confirmation_status' => $key[1],
        ]);
    }
    public function delete($id)
    {
        $season = Season::find($id);
        return  $season->delete();
    }
    public function lock($id)
    {
        return Season::where('id', $id)->update([
            'status' => 'lock',
        ]);
    }
    public function open($id)
    {
        return Season::where('id', $id)->update([
            'status' => 'open',
        ]);
    }

    public function allSeason($id){
        return Season::where('course_id', $id)->where('confirmation_status' , 'accepted')->orderBy('number', 'desc')->get();
    }
}
