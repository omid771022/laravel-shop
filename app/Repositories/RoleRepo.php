<?php


namespace App\Repositories;
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
$role=$this->roleFindById($id);
return $role->syncPermissions($request['permissions'])->update(['name' => $request->name]);
}

public function delete($id){
    return  Role::where('id', $id)->delete();
  }

}
