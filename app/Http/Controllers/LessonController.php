<?php

namespace App\Http\Controllers;

use App\Media;
use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use App\Repositories\LessonRepoInterface;

class LessonController extends Controller
{


    public $lessonrepo;

    public function __construct(LessonRepoInterface $lessonrepo)
    {

        $this->lessonrepo = $lessonrepo;
    }

    public function store(LessonRequest $request, $id)
    {
        $this->lessonrepo->store($request, $id);
        newFeedback("جلسه با موفقیت ثبت گردید", "feedbacks");
        return back();
    }
    public function delete($id)
    {
        $this->lessonrepo->delete($id);
        newFeedback("جلسه با موفقیت حذف گردید", "feedbacks");
        return back();
    }


//delete mutiple lesson
    public function deleteMultiple(Request $request, $id)
    {
        $this->lessonrepo->deleteMultiple($request);
        //send message to 
        newFeedback("جلسه با موفقیت حذف گردید", "feedbacks");
        return back();
    }
}
