<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use App\Repositories\CouresRepoInterface;
use App\Repositories\LessonRepoInterface;
use App\Repositories\CategoryRepoInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $categoryRepo;
    public $courseRepo;
    public $lessonRepo;
    public function __construct(CategoryRepoInterface $categoryRepo, CouresRepoInterface $courseRepo, LessonRepoInterface $lessonRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->categoryRepo = $categoryRepo;
        $this->lessonRepo = $lessonRepo;
    }


    public function index()
    {
    
        $latestCourses = $this->courseRepo->latestCourses();

        return view('index', compact('latestCourses'));
    }
    public function singleCourse($slug)
    {
  
        $courseId = $this->extractId($slug, 'c');
        $course = $this->courseRepo->findByid($courseId);
        $lessons = $this->lessonRepo->getAcceptedLessons($courseId);
        $lesson ="";
        if (request()->lesson) {
            $lesson = $this->lessonRepo->getLesson($courseId, $this->extractId(request()->lesson, 'l'));
          
        } else {
            $lesson = $this->lessonRepo->getFirstLesson($courseId);
        }
        return view('SingleCourse', compact('course', 'lessons', 'lesson'));
    
    }

    public function extractId($slug, $key)
    {
        return Str::before(Str::after($slug, $key .'-'), '-');
    }

}
