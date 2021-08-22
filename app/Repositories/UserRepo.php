<?php

namespace App\Repositories;

use App\User;


class UserRepo{
    public function FindByEmail($email){
        return  User::where('email', $email)->first();
    }
}

?>