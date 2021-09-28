<?php

namespace App\Http\Controllers;


use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;

class UserController extends Controller
{


    public $userRepo;
    public $roleRepo;
    public function __construct( UserRepoInterface $userRepo , RoleRepoInterface $roleRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->userRepo = $userRepo;
    }
  

    public function index(){
        $roles = $this->roleRepo->roleAll();
        $users= $this->userRepo->paginate();
        return view('Dashboard.User.Admin.index', compact(['users', 'roles']));
    }
}
