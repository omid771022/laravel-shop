<?php

namespace App\Repositories;
use App\Repositories\UserRepoInterface;
use App\User;


class UserRepo implements UserRepoInterface {
    public function FindByEmail($email){
        return  User::where('email', $email)->first();
    }
public function UserAll(){
    return User::all();
}

}

?>