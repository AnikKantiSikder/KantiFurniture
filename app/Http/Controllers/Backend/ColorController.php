<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Color;
use App\Http\Requests\ColorRequest;
use DB;
use Auth;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //View color-----------------------------------------------------------------------
    public function view(){

    	$data['allData']= Color::all();

    	return view('Backend.Color.view_color', $data);
    }


    //Add color-------------------------------------------------------------------------
    public function add(){
    	return view('Backend.Color.add_color');
    }

    //Store color
    public function store(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:colors,name'
    	]);

    	$data= new Color();

    	$data->name= $request->name; 
        $data->created_by= Auth::user()->id;
    	// return response()->json($data);
    	$data->save();

    	return redirect()->route('colors.view')->with('success','Data added successfully');

    }

    //Edit color----------------------------------------------------------------------------
    public function edit($id){

       $editColorData= Color:: find($id);
       
    	return view('Backend.Color.add_color', compact('editColorData')); //Add and edit in under one page
    }


    //Update color--------------------------------------------------------------------------
    public function update(ColorRequest $request, $id){

    	$data= Color:: find($id);

    	$data->name= $request->name;
    	$data->updated_by= Auth::user()->id;

    	$data->save();

    	return redirect()->route('colors.view')->with('success', 'Data updated successfully');
    }

    //Delete Color-------------------------------------------------------------------------------
    public function delete($id){

    	$colorData= Color:: find($id);

    	$colorData->delete(); 

    	return redirect()->route('colors.view')->with('success', 'Color deleted successfully');
    }




//Ends here
}
