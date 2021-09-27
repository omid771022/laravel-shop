<?php


namespace App\Repositories;
use App\User;
use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepoInterface;


class RoleRepo implements RoleRepoInterface{
    public function roleAll(){
        return Role::all();
    }

    public function rolePermssion($request){
   
        return Role::create(['name'=> $request->name])->syncPermissions($request->permissions);
    }



public function roleFindById($id){
  return  Role::where('id', $id)->first();
}

public function updateRolePermission($request, $id){

$user=User::find($id);

$user->syncRoles($request['permissions']);

}

public function delete($id){
 $user= User::where('id', $id)->first();
 $user->removeRole($user->roles->first());
return back();

    // return  Role::where('id', $id)->delete();
  }

}
