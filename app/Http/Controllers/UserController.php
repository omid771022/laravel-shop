<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Repositories\RoleRepoInterface;
use App\Repositories\UserRepoInterface;
use App\Http\Requests\UpdateUserRequest;

use App\Http\Requests\UpdateProfileInformationRequest;

class UserController extends Controller
{


    public $userRepo;
    public $roleRepo;
    public function __construct(UserRepoInterface $userRepo, RoleRepoInterface $roleRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->userRepo = $userRepo;
    }


    public function index()
    {
        $roles = $this->roleRepo->roleAll();
        $users = $this->userRepo->paginate();
        return view('Dashboard.User.Admin.index', compact(['users', 'roles']));
    }
    public function edit($id)
    {
        $user = $this->userRepo->findByUserId($id);
        return view('Dashboard.User.Admin.edit', compact('user'));
    }
    public function update(Request  $request,  $id)
    {
        $this->authorize('admin');
        $password = "";
        $fullnameFile = '';
        if (empty($request['password'])) {
            $user = User::find($id);
            $password = $user['password'];
        } else {

            $pass = Hash::make($request['password']);
            $password = $pass;
        }
        if ($request->has('image')) {
            $file = $request->file('image');
            $imagePath = public_path('uploads/user/' . $request->image);
            if (File::exists($imagePath)) {
                unlink($imagePath);
            }
            $imageName = uniqid();
            $extention = $file->extension();
            $fullnameFile = $imageName . '.' . $extention;
            $file->move(public_path("/uploads/user/"), $fullnameFile);
        } else {
            $user = User::find($id);
            $fullnameFile = $user->image;
        }
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'username' => $request->username,
            'headline' => $request->headline,
            'website' => $request->website,
            'linkedin' => $request->linkedin,
            'tiwitter' => $request->twitter,
            'status' => $request->status,
            'password' => $password,
            'bio' => $request->bio,
            'image' => $fullnameFile,
        ]);
        session()->flash('message', 'کار بر با موفقیت اپدیت شد');
        return redirect()->back();
    }
    public function destroy($id)
    {

        $user = $this->userRepo->findByUserId($id);
        $user->delete();
        session()->flash('delete', 'کار بر با موفقیت حذف شد ');
        return redirect()->back();
    }
    public function manualVerify($id)
    {
        $this->authorize('admin');
        $user = $this->userRepo->findByUserId($id);
        $user->markEmailAsVerified();
        newFeedback(" با موفقیت تایید شد {$user->name} ایمیل کاربر", "success");


        return redirect()->back();
    }
    public function Userphoto(UpdateuserRequest $request)
    {

        $id = auth()->user()->id;
        $user = $this->userRepo->findByUserId($id);
        if ($request->has('userphoto')) {
            $file = $request->file('userphoto');
            $imagePath = public_path('/uploads/upload/' . $user->image);
            if (File::exists($imagePath)) {
                unlink($imagePath);
            } else {
            }
            $imageName = uniqid();
            $extention = $file->extension();
            $fullnameFile = $imageName . '.' . $extention;
            $file->move(public_path("/uploads/upload/"), $fullnameFile);
        }
        User::where('id', $id)->update([
            'image' => $fullnameFile,
        ]);
        newFeedback('message', 'کاربر با موفقیت عکس پروفایلش تغییر کرد ');
        return back();
    }

    public function  userProfile(){

        return view('Dashboard.User.Admin.profile');
    }
    public function usersProfileUpdate(UpdateProfileInformationRequest $request){
     $this->userRepo->usersProfileUpdate($request);
     newFeedback('feedbacks', ' با موفقیت اپدیت شد ');
     return back();
    }

    public function details($id){
        dd($id);

    }
}
