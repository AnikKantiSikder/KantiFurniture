<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    //View profile---------------------------------------------------
    public function view(){

    	$userId= Auth::user()->id;
    	$userData= User::find($userId);

    	return view('Backend.User.view_profile', compact('userData'));
    }

    //Edit profile---------------------------------------------------
    public function edit(){

    	$userId= Auth::user()->id;
    	$editUser= User::find($userId);

    	return view('Backend.User.edit_profile', compact('editUser'));
    }

    //Update profile--------------------------------------------------
    public function update(Request $request){

        $data= User:: find(Auth::user()->id);

    	$data->name= $request->name;
    	$data->email= $request->email;
    	$data->mobile= $request->mobile;
    	$data->address= $request->address;
    	$data->gender= $request->gender;

    	if($request->file('image')){
    		$file= $request->file('image');
    		@unlink(public_path('Upload/User_images/'.$data->image));
    		$filename= date('YmdHi').$file->getClientOriginalName();
    		$file-> move(public_path('Upload/User_images'), $filename);
    		$data['image']= $filename;
    	}

    	// return response()->json($data);
    	$data->save();

    	return redirect()->route('profiles.view')->with('success', 'Data updated successfully');
    }

    //Edit password
    public function changePassword(){

    	return view('Backend.User.edit_password');
    }

    //Update password
    public function updatePassword(Request $request){

    	if(Auth::attempt(['id'=> Auth::user()->id, 'password'=>$request->current_password])){

    		$user= User::find(Auth::user()->id);
    		$user->password= bcrypt($request->new_password);
    		$user->save();
    		return redirect()->route('profiles.view')->with('success', 'Password updated successfully');
    	}
    	else{
    		return redirect()->back()->with('error', 'Sorry! your current password does not match');
    	}
    }


//Ends here
}
