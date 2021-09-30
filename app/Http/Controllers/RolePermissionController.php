<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use App\Http\Requests\RoleUserRequest;
use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\PermissionRepoInterface;
use Spatie\Permission\Models\Role as ModelsRole;

class RolePermissionController extends Controller
{


    public $repoRole;
    public $repoPermission;
    public  $userRepo;
    public function __construct(RoleRepoInterface $roleRepo, PermissionRepoInterface $repoPermission, UserRepoInterface $userRepo)
    {
        $this->repoRole = $roleRepo;
        $this->repoPermission = $repoPermission;
        $this->userRepo = $userRepo;
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


        $user = Role::find($id);


        $roles = $this->repoRole->roleAll();

        return view('Dashboard.RolePermission.edit', compact(['roles', 'user']));
    }
    public function  updatePermissionRole(Request $request, $id)
    {

        $this->repoRole->updateRolePermission($request, $id);
        return redirect()->route('RolePermission.index');
    }

    public function delete($user, $role)
    {
        $this->repoRole->delete($user, $role);
        session()->flash('delete', ' نقش از کاربر با موفقیت گرفته شده ');
        return back();
    }
    public function permissionDelete($role, $permission)
    {
        $this->repoRole->permission_delete($role, $permission);
        session()->flash('delete_Permssion', 'دسترسی از  نقش گرفته شد ');
        return back();
    }

    public function addPermiison()
    {
        $this->authorize('admin');
        $users = $this->userRepo->userAll();
        $Roles = $this->repoRole->roleAll();
        $roles = \Spatie\Permission\Models\Role::all();
        $allUserRole =  User::role($roles)->get();
        return view('Dashboard.RolePermission.user', compact(['Roles', 'users', 'allUserRole']));
    }

    public function adduser(RoleUserRequest $request)
    {


        $role = $request['Role'];
        $user_id = $request['user_id'];
        $user = User::where('id', $user_id)->first();
        $user->syncRoles($role);
        session()->flash('feedback', ['title' => 'موفقیت امیز', "body" => 'داده شد' . "نقش کاربر" . $user->name]);
        return back();
    }
    public function editRole($userRole, $user)
    {
        $user = User::where('id', $user)->first();
        $role = $this->repoRole->roleFindById($userRole);
        $roles = $this->repoRole->roleAll();
        return view('Dashboard.RolePermission.RoleEdit', compact(['roles', 'user', 'userRole']));
    }
    public function updateRole(Request  $request,  $id)
    {
        $user = User::where('id', $id)->first();
        $user->syncRoles($request['permissions']);
        return back();
    }
    
    public function deleteAllRoles(){

    }
    public function deleteAllPermissions(){

    }
}
