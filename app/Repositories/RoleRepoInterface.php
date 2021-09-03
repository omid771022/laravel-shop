<?php

namespace App\Repositories;


interface RoleRepoInterface{

public function roleAll();
public function permissionAll();
public function rolePermssion($request);
public function permissionCreate($request);
}


?>