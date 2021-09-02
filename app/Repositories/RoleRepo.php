<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleRepo{
    public function roleAll(){
        return Role::all();
    }

    public function permissionAll(){
       return Permission::all();
    }

    public function rolePermssion($request){
        // return Role::create(['name' => $request->name])->syncPermissions($request->permissions);
        return Role::create(['name'=> $request->name])->syncPermissions($request->permissions);
    }
}
?>