<?php

namespace App\Http\Controllers;

use App\Media;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CouresRequest;
use Illuminate\Support\Facades\File;
use App\Repositories\UserRepoInterface;
use App\Repositories\CouresRepoInterface;
use App\Repositories\CategoryRepoInterface;

class CourseController extends Controller
{
    public $repo;
    public $userRepo;
    public $categoryRepo;
    public $courseRepo;
    public function __construct(UserRepoInterface $userRepo, CategoryRepoInterface $categoryRepo, CouresRepoInterface $courseRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->categoryRepo = $categoryRepo;
        $this->repo = $userRepo;
    }
    public function create()
    {
        $this->authorize('view', Course::class);
        $courses = $this->courseRepo->paginate();
        return view('Dashboard.Course.create', compact('courses'));
    }

    public function index()
    {

        $techers = $this->repo->getTeacher();
        $categories = $this->categoryRepo->all();


        return view('Dashboard.Course.index', compact(['techers', 'categories']));
    }

    public function store(CouresRequest $request)
    {
        $this->courseRepo->storeCoures($request);
        return back();
    }
    public function delete($id)
    {

        $this->courseRepo->delete($id);
        return back();
    }
    public function edit($id)
    {
        $teachers = $this->repo->getTeacher();
        $categories = $this->categoryRepo->all();
        $course = $this->courseRepo->findById($id);
        return view('Dashboard.Course.edit', compact(['teachers', 'categories', 'course']));
    }
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if ($request->has('image')) {
            $file = $request->file('image');
            $imagePath = public_path('uploads/course/' . $course->media->files);
            if (File::exists($imagePath)) {
                unlink($imagePath);
            }
            $imageName = uniqid();
            $extention = $file->extension();
            $fullnameFile = $imageName . '.' . $extention;
            $file->move(public_path("/uploads/course/"), $fullnameFile);
            Media::where('id', $course->media->id)->update([
                'files' => $fullnameFile,
                'type' => "image",
                "user_id" => auth()->id(),
                "filename" => $imageName,
            ]);

            Course::where('id', $id)->update([
                'teacher_id' => $request->teacher_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'banner_id' => $course->media->id,
                'proiority' => $request->priority,
                'price' => $request->price,
                'percent' => $request->percent,
                'type' => $request->typeBuy,
                'enum' => $request->statusEnum,
                'body' => $request->body,
            ]);
        } else {
            Course::where('id', $id)->update([
                'teacher_id' => $request->teacher_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'slug' => $request->slug,
                'banner_id' => $course->media->id,
                'proiority' => $request->priority,
                'price' => $request->price,
                'percent' => $request->percent,
                'type' => $request->typeBuy,
                'enum' => $request->statusEnum,
                'body' => $request->body,
            ]);

            return redirect()->route('course.create');
        }
    }

    public function accept($id)
    {
        $this->courseRepo->updateStatus($id);
        return back();
    }
    public function pending($id)
    {
        $this->courseRepo->updateStatusPending($id);
        return back();
    }
    public function reject($id)
    {
        $this->courseRepo->updateStatusRejected($id);
        return back();
    }
public function details($id){
  $course =  $this->courseRepo->findById($id);
    return  view('Dashboard.Course.details', compact('course'));
}
    
}
