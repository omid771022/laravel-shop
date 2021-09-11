<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Repositories\PermissionRepo;
use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\PermissionRepoInterface;

class RolePermissionController extends Controller
{


    public $repoRole;
    public $repoPermission; 
    public function __construct(RoleRepoInterface $roleRepo, PermissionRepoInterface $repoPermission)
    {
        $this->repoRole = $roleRepo;
        $this->repoPermission = $repoPermission;
    }


    public function index()
    {
        $roles = $this->repoRole->roleAll();
        $Permissions = $this->repoPermission->permissionAll();

        return view('Dashboard.RolePermission.index', compact(['roles', 'Permissions']));
    }

    public function store(RoleRequest $request)
    {

        $this->repoRole->rolePermssion($request);
        return back();
    }


    public function storePermissions(Request $request)
    {
        $this->repoPermission->permissionCreate($request);
        return back();
    }

    public function editPermissionRole($id)
    {


        $role = $this->repoRole->roleFindById($id);

        $permissions = $this->repoPermission->permissionAll();
        return view('Dashboard.RolePermission.edit', compact(['permissions', 'role']));
    }
    public function  updatePermissionRole(RoleUpdateRequest $request, $id)
    {
        $this->repoRole->updateRolePermission($request, $id);
        return redirect()->route('RolePermission.index');
    }
}
