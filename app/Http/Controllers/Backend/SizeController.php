<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Size;
use App\Http\Requests\SizeRequest;
use DB;
use Auth;

class SizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //View size-----------------------------------------------------------------------
    public function view(){

    	$data['allData']= Size::all();

    	return view('Backend.Size.view_size', $data);
    }


    //Add size-------------------------------------------------------------------------
    public function add(){
    	return view('Backend.Size.add_size');
    }

    //Store size
    public function store(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:sizes,name'
    	]);

    	$data= new Size();

    	$data->name= $request->name; 
        $data->created_by= Auth::user()->id;
    	// return response()->json($data);
    	$data->save();

    	return redirect()->route('sizes.view')->with('success','Data added successfully');

    }

    //Edit size----------------------------------------------------------------------------
    //Add and edit in under one page
    public function edit($id){

       $editSizeData= Size:: find($id);
       
    	return view('Backend.Size.add_size', compact('editSizeData')); 
    }


    //Update size--------------------------------------------------------------------------
    public function update(SizeRequest $request, $id){

    	$data= Size:: find($id);

    	$data->name= $request->name;
    	$data->updated_by= Auth::user()->id;

    	$data->save();

    	return redirect()->route('sizes.view')->with('success', 'Data updated successfully');
    }

    //Delete size-------------------------------------------------------------------------------
    public function delete($id){

    	$SizeData= Size:: find($id);

    	$SizeData->delete(); 

    	return redirect()->route('sizes.view')->with('success', 'Size deleted successfully');
    }




//Ends here
}
