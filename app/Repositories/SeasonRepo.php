<?php

namespace App\Repositories;

use App\Course;
use App\Season;
use App\Repositories\SasonRepoInterface;

class SeasonRepo implements SeasonRepoInterface
{
    public function findByIdSeasons($id)
    {
        return Season::find($id);
    }
    public function store($request, $id)
    {
        $course = Course::find($id);
     

      if(is_null($request->number)){
        $number=  $course->seasons()->orderBy('number', 'desc')->firstOrNew([])->number?: 0 ;
        $number++;
 
        }
        return Season::create([
            'title' =>  $request->title,
            'number' => $number,
            'confirmation_status' => 'pending',
            'course_id' => $id,
            'user_id'=>auth()->user()->id,
        ]);
    }
}
