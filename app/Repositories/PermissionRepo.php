<?php


namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use App\Repositories\PermissionRepoInterface;


class PermissionRepo implements PermissionRepoInterface{
    public function permissionAll(){
       return Permission::all();
    }


public function permissionCreate($request){
   return Permission::create([
        'name' => $request->name,
    ]);

}
 
public function addRolePremssion(){




    


}

}
