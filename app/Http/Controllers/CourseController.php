<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepoInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{


    public $repo;
    public function __construct(UserRepoInterface $userRepo)
    {
        $this->repo = $userRepo;
    }

    public function index(){
  
  $teachers =$repo->get_teacher();

return view('Dashboard.Course.index');
    }

    public function store(){



    }
}
