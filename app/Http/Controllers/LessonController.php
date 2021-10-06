<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use App\Repositories\LessonRepoInterface;

class LessonController extends Controller
{
    

    public $lessonrepo;
  
    public function __construct( LessonRepoInterface $lessonrepo)
    {
       
        $this->lessonrepo = $lessonrepo;
    }

    public function store(LessonRequest $request, $id){
$this->lessonrepo->store($request, $id);
newFeedback("جلسه با موفقیت ثبت گردید", "feedbacks");
return back();
    }

}
