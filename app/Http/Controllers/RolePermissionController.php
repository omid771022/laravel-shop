<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RoleRepo;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{


    public $repo;
    public function __construct(RoleRepo $roleRepo)
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
        Permission::create([
            'name' => $request->name,
        ]);
        return back();
    }
}
