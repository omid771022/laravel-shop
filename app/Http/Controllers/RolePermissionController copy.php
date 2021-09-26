<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;

use App\Repositories\PermissionRepoInterface;
use App\Repositories\PermissionRepo;
use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;

class RolePermissionController extends Controller
{


    public $repo;
    public $userRepo;
    public function __construct(RoleRepoInterface $roleRepo, UserRepoInterface $userRepo)
    {
        $this->repo = $roleRepo;
        $this->userRepo = $userRepo;
    }
  

    public function index()
    {
        $roles = $this->repo->roleAll();
        $Permissions =$this->repo->permissionAll() ;
        $userRepo = $this->userRepo->userAll();
        return view('Dashboard.RolePermission.index', compact(['roles', 'Permissions', 'userRepo']));
    }

    public function store(RoleRequest $request)
    {

        $this->repo->rolePermssion($request);
        return back();

    }


    public function storePermissions(Request $request)
    {
    $this->repo->permissionCreate($request);
        return back();
    }
    public function editPermissionRole(Request $request, $id){
    
    }
}
