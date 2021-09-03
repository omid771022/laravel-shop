<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepoInterface;
use Spatie\Permission\Models\Permission;

class RoleRepo implements RoleRepoInterface{
    public function roleAll(){
        return Role::all();
    }

    public function permissionAll(){
       return Permission::all();
    }

    public function rolePermssion($request){
   
        return Role::create(['name'=> $request->name])->syncPermissions($request->permissions);
    }


public function permissionCreate($request){
   return Permission::create([
        'name' => $request->name,
    ]);
}


}
?>