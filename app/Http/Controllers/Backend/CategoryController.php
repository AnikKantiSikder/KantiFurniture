<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Http\Requests\CategoryRequest;
use DB;
use Auth;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //View category-----------------------------------------------------------------------
    public function view(){

    	//$data['countCategory']= Category::count();
    	$data['allData']= Category::all();

    	return view('Backend.Category.view_category', $data);
    }


    //Add category-------------------------------------------------------------------------
    public function add(){
    	return view('Backend.Category.add_category');
    }

    //Store category
    public function store(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:categories,name'
    	]);

    	$data= new Category();

    	$data->name= $request->name; 
        $data->created_by= Auth::user()->id;
    	// return response()->json($data);
    	$data->save();

    	return redirect()->route('categories.view')->with('success','Data added successfully');

    }

    //Edit category----------------------------------------------------------------------------
    public function edit($id){

       $editCategoryData= Category:: find($id);
       
    	return view('Backend.Category.add_category', compact('editCategoryData')); //Add and edit in under one page
    }


    //Update category--------------------------------------------------------------------------
    public function update(CategoryRequest $request, $id){

    	$data= Category:: find($id);

    	$data->name= $request->name;
    	$data->updated_by= Auth::user()->id;

    	$data->save();

    	return redirect()->route('categories.view')->with('success', 'Data updated successfully');
    }

    //Delete category-------------------------------------------------------------------------------
    public function delete($id){

    	$about= Category:: find($id);

    	$about->delete(); 

    	return redirect()->route('categories.view')->with('success', 'Category deleted successfully');
    }
}
