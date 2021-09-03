<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;

class RolePermissionController extends Controller
{


    public $repo;
    
    public function __construct(RoleRepoInterface $roleRepo)
    {
        $this->repo = $roleRepo;
     
    }
  

    public function index()
    {
        $roles = $this->repo->roleAll();
        $Permissions =$this->repo->permissionAll() ;

        return view('Dashboard.RolePermission.index', compact(['roles', 'Permissions']));
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
}
