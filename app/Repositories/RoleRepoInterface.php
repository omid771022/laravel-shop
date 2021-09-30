<?php

namespace App\Repositories;


interface RoleRepoInterface{

public function roleAll();
public function rolePermssion($request);
public function roleFindById($id);
public function updateRolePermission($id, $request);
public function delete($user,$role);
public function permission_delete($role, $permission);

}


