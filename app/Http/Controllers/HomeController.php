<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Repositories\CouresRepoInterface;
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

    public function __construct( CategoryRepoInterface $categoryRepo, CouresRepoInterface $courseRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->categoryRepo = $categoryRepo;

    }


    public function index()
    {
        $categories = Category::where('parent_id', null)->get();
        $latestCourses=$this->courseRepo->latestCourses();
      
        return view('index', compact('categories','latestCourses'));
    }

    
}
