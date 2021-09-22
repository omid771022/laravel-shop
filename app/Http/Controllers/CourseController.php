<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepoInterface;
use App\Repositories\CategoryRepoInterface;

class CourseController extends Controller
{


    public $repo;

    public $userRepo;
    public $categoryRepo;
    public function __construct(UserRepoInterface $userRepo, CategoryRepoInterface $categoryRepo)

    {
        $this->categoryRepo = $categoryRepo;    
        $this->repo = $userRepo;
    }

    public function index(){
  
 $techers= $this->repo->getTeacher();
 $categories= $this->categoryRepo->all();


return view('Dashboard.Course.index', compact(['techers','categories']));
    }

    public function store(){



    }
}
