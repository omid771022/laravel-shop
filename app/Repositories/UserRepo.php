<?php

namespace App\Repositories;
use App\User;
use App\Repositories\UserRepoInterface;


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



public function usersProfileUpdate($request){

    \Auth()->user()->name = $request->name;
    if( \Auth()->user()->email != $request->email){
        \Auth()->user()->email = $request->email;
        \Auth()->user()->email_verified_at = null;
    } 

    if (auth()->user()->hasPermissionTo('teach')) {
        auth()->user()->card_number = $request->card_number;
        auth()->user()->shaba = $request->shaba;
        auth()->user()->headline = $request->headline;
        auth()->user()->bio = $request->bio;
        auth()->user()->username = $request->username;
    }

    if ($request->password) {
        auth()->user()->password = bcrypt($request->password);
    }


    \Auth()->user()->save();
}

}




?>