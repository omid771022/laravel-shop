<?php
namespace App\Repositories;

interface CouresRepoInterface {
public function storeCoures($request);
public function paginate();
public function findById($id);
public function delete($id);
public function updateStatus($id);
}


?>