<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Brand;
use App\Http\Requests\BrandRequest;
use DB;
use Auth;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //View brand-----------------------------------------------------------------------
    public function view(){

    	$data['allData']= Brand::all();

    	return view('Backend.Brand.view_brand', $data);
    }


    //Add brand-------------------------------------------------------------------------
    public function add(){
    	return view('Backend.Brand.add_brand');
    }

    //Store brand
    public function store(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:brands,name'
    	]);

    	$data= new Brand();

    	$data->name= $request->name; 
        $data->created_by= Auth::user()->id;
    	// return response()->json($data);
    	$data->save();

    	return redirect()->route('brands.view')->with('success','Data added successfully');

    }

    //Edit brand----------------------------------------------------------------------------
    public function edit($id){

       $editBrandData= Brand:: find($id);
       
    	return view('Backend.Brand.add_brand', compact('editBrandData')); //Add and edit in under one page
    }


    //Update brand--------------------------------------------------------------------------
    public function update(BrandRequest $request, $id){

    	$data= Brand:: find($id);

    	$data->name= $request->name;
    	$data->updated_by= Auth::user()->id;

    	$data->save();

    	return redirect()->route('brands.view')->with('success', 'Data updated successfully');
    }

    //Delete brand-------------------------------------------------------------------------------
    public function delete($id){

    	$about= Brand:: find($id);

    	$about->delete(); 

    	return redirect()->route('brands.view')->with('success', 'Brand deleted successfully');
    }




//Ends here
}
