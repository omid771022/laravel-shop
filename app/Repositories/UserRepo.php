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
public function getTeacher(){
    return User::permission('teach')->get();
}
public function findByUserId($id){
return User::where('id', $id)->first();
}


public function paginate()
{
    return User::paginate();
}
public function update($id , $request){

   
    $update = [
      
    ];
    if (! is_null($request->password)) {
        $update['password'] = bcrypt($request->password);
    }
    return User::where('id', $id)->update([

        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'username' => $request->username,
        'headline' => $request->headline,
        'website' => $request->website,
        'instagram' => $request->instagram,
        'linkedin' => $request->linkedin,
        'twitter' => $request->twitter,
        'facebook' => $request->facebook,
        'youtube' => $request->youtube,
        'status' => $request->status,
        'password' => $request->password,
        'bio' => $request->bio,
        'image_id' => $request->image_id
    ]);
}
}




?>