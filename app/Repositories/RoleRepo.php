<?php


namespace App\Repositories;

use App\User;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepoInterface;


class RoleRepo implements RoleRepoInterface
{
  public function roleAll()
  {
    return Role::all();
  }

  public function rolePermssion($request)
  {

    return Role::create(['name' => $request->name])->syncPermissions($request->permissions);
  }
  public function roleFindById($id)
  {
    return  Role::where('id', $id)->first();
  }
  public function updateRolePermission($request, $id)
  {
    $user = Role::find($id);

    $user->syncPermissions($request['permissions']);
  }

  public function delete($user, $role)
  {

    $user = User::where('id', $user)->first();
    $user->removeRole($role);
  }

  public function permission_delete($role, $permission)
  {
    $Role = $this->roleFindById($role);
    $Role->revokePermissionTo($permission);
  }
}
