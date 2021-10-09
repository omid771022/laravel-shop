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

 public function rjectMultiple(request $request){

    $this->lessonrepo->rjectMultiple($request);
    newFeedback("جلسات با موفقیت رد  گردید", "feedbacks");
    return back();
 }


    public function accept($id)
    {
        $this->lessonrepo->accept($id);
        newFeedback("جلسه با موفقیت تایید شد ", "feedbacks");
        return back();
    }
    public function pending($id)
    {
        $this->lessonrepo->pending($id);
        return back();
    }
    public function reject($id)
    {
        $this->lessonrepo->reject($id);
        newFeedback("جلسه با موفقیت رد شد", "feedbacks");
        return back();
    }


    public function lock($id)
    {
        $this->lessonrepo->lock($id);
        newFeedback("جلسه با موفقیت قفل  گردید", "feedbacks");
        return back();
    }

    public function open($id)
    {
        $this->lessonrepo->open($id);
        newFeedback("جلسه با موفقیت باز  گردید", "feedbacks");
        return back();
    }
    
    public function confirmMultiple(Request $request){
        $this->lessonrepo->confirmMultiple($request);
        newFeedback("جلسه با موفقیت باز  گردید", "feedbacks");
        return back();
    }
}
