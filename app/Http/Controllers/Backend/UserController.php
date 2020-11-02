<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function view(){

    	$data['allData']= User::where('user_type', 'Admin')->where('status', '1')->get();

    	return view('Backend.User.view_user', $data);
    }

    //Add users
    public function add(){
    	return view('Backend.User.add_user');
    }

    //Store users
    public function store(Request $request){

    	// $this->validate($request,[
     //        'name' => 'required',
     //        'email' => 'required|email|unique:users',
     //        'password' => 'required|min:6',
     //        'usertype' => 'required',
     //    ]);

        // $userinfo = User::create([
        //     'name' => $this->name,
        //     // 'username' => $this->username,
        //     'email' => $this->email,
        //     'password' => Hash::make($this->password),
        //     'remember_token' => Str::random(10),
        // ]);

        // $userinfo->assignRole($this->usertype);
        // $this->redirect('/users');

    	$this->validate($request, [
    		'name'=> 'required',
    		'email'=> 'required|unique:users',
    		'userrole'=> 'required',
    		'password' => 'required| min:6',
            'password_confirmation' => 'required| min:6'
    		
    	]);

    	$data= new User();

        $data->user_type= 'Admin';
        $data->role= $request->userrole;
    	$data->name= $request->name;
    	$data->email= $request->email;
    	$data->password= bcrypt($request->password_confirmation);

    	// return response()->json($data);
    	$data->save();

    	return redirect()->route('users.view')->with('success','Data added successfully');

    }

    //Edit user
    public function edit($id){

       $allData= User:: find($id);
       
       return view('Backend.User.edit_user', compact('allData'));
    }


    //Update user
    public function update(Request $request, $id){

    	$data= User:: find($id);

        $data->role= $request->userrole;
    	$data->name= $request->name;
    	$data->email= $request->email;
    	// return response()->json($data);
    	$data->save();

    	return redirect()->route('users.view')->with('success', 'Data updated successfully');
    }

    //Delete user
    public function delete($id){

    	$userData= User:: find($id);
        
            if(file_exists('public/Upload/User_images/'. $userData->image) AND !empty($userData->image) ){

                unlink('public/Upload/User_images/'.$userData->image);
            }

    	$userData->delete();

    	return redirect()->route('users.view')->with('success', 'Data deleted successfully');
    }



//Ends hwere
}
