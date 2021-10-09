<?php

namespace App\Http\Controllers;

use App\Media;
use App\Lesson;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use Illuminate\Support\Facades\File;
use App\Repositories\CouresRepoInterface;
use App\Repositories\LessonRepoInterface;
use App\Repositories\SeasonRepoInterface;

class LessonController extends Controller
{

    public $sasonrepo;
    public $lessonrepo;
    public $courserepo;

    public function __construct(LessonRepoInterface $lessonrepo, SeasonRepoInterface $sasonrepo, CouresRepoInterface $courserepo)
    {
        $this->courserepo = $courserepo;
        $this->sasonrepo = $sasonrepo;
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

    public function rjectMultiple(request $request)
    {

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

    public function confirmMultiple(Request $request)
    {
        $this->lessonrepo->confirmMultiple($request);
        newFeedback("جلسه با موفقیت باز  گردید", "feedbacks");
        return back();
    }


    public function edit($lessonId, $courseId)
    {

        $seasons = $this->sasonrepo->allSeason($courseId);
        $lesson = $this->lessonrepo->findById($lessonId);
        $course = $this->courserepo->findById($courseId);

        return view('Dashboard.Course.lessons.edit', compact(['course', 'lesson', 'seasons']));
    }
    public function update($courseId, $lessonId, LessonRequest $request)
    {

        
        $Files = "";
        $file = "";
        $extention = "";
        $lesson = $this->lessonrepo->findById($lessonId);
        $lesseon_files = $lesson->media->files;
    
        if ($request->file('lesson_file')) {
            $Files = $request->file('lesson_file');
     
            $imagePath = storage_path('uploads/lesson/' . $lesseon_files);
            if (File::exists($imagePath)) {
                unlink($imagePath);
            }
            $imageName = uniqid();
            $extention = $Files->getClientOriginalExtension();
          
            $file = $imageName . '.' . $extention;
            $Files->move(storage_path("/uploads/lesson/"), $file);
      
        } else {
            $file = $lesseon_files;
       
            $imageName=$lesson->media->filename;;
        }

        if ($extention == "mp4" || "mp3") {
            $extention = "video";
        }

        Media::where('id', $lesson->media->id)->update([
            'files' => $file,
            'type' =>$extention,

            "user_id" => auth()->id(),
            "filename" => $imageName,
        ]);
        Lesson::where('id', $lessonId)->update([
            "title" => $request->title,
            "slug" => $request->slug,
            "time" => $request->time,
            "proiority" => $request->number,
            'season_id' => $request->season_id,
            'free' => $request->free,
            'body' => $request->body,

        ]);
return back();





        // 615f091e8fabc.mp4
        // if ($request->has('lesson_file')) {
        //     $file = $request->file('image');
        //     $imagePath = public_path('uploads/course/' . $course->media->files);
        //     if (File::exists($imagePath)) {
        //         unlink($imagePath);
        //     }
        //     $imageName = uniqid();
        //     $extention = $file->extension();
        //     $fullnameFile = $imageName . '.' . $extention;
        //     $file->move(public_path("/uploads/course/"), $fullnameFile);

        //     Media::where('id', $course->media->id)->update([
        //         'files' => $fullnameFile,
        //         'type' => "image",
        //         "user_id" => auth()->id(),
        //         "filename" => $imageName,
        //     ]);
        //     Course::where('id', $id)->update([
        //         'teacher_id' => $request->teacher_id,
        //         'category_id' => $request->category_id,
        //         'title' => $request->title,
        //         'slug' => $request->slug,
        //         'banner_id' => $course->media->id,
        //         'proiority' => $request->priority,
        //         'price' => $request->price,
        //         'percent' => $request->percent,
        //         'type' => $request->typeBuy,
        //         'enum' => $request->statusEnum,
        //         'body' => $request->body,
        //     ]);
        // } else {
        //     Course::where('id', $id)->update([
        //         'teacher_id' => $request->teacher_id,
        //         'category_id' => $request->category_id,
        //         'title' => $request->title,
        //         'slug' => $request->slug,
        //         'banner_id' => $course->media->id,
        //         'proiority' => $request->priority,
        //         'price' => $request->price,
        //         'percent' => $request->percent,
        //         'type' => $request->typeBuy,
        //         'enum' => $request->statusEnum,
        //         'body' => $request->body,
        //     ]);

        //     return redirect()->route('course.create');

    }
}
