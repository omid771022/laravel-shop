<?php
 namespace App\Repositories;

interface UserRepoInterface{
    public function FindByEmail($email);
    public function userAll();
}
?>