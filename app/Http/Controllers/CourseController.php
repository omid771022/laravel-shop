<?php

namespace App\Http\Controllers;

use App\Media;
use App\Http\Requests\CouresRequest;
use App\Services\MediaUploadService;
use Intervention\Image\Facades\Image;
use App\Repositories\UserRepoInterface;
use App\Repositories\CouresRepoInterface;
use Symfony\Component\Console\Input\Input;
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

    public function index()
    {

        $techers = $this->repo->getTeacher();
        $categories = $this->categoryRepo->all();


        return view('Dashboard.Course.index', compact(['techers', 'categories']));
    }

    public function store(CouresRequest $request)
    {


      


   $course = $this->courseRepo->storeCoures($request);
   return $course;


    }
}
