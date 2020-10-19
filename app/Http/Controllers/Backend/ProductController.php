<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Size;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\ProductSize;
use App\Model\ProductSubImage;
use App\Http\Requests\ProductRequest;
use DB;
use Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //View product-----------------------------------------------------------------------
    public function view(){

    	$data['allData']= Product::all();

    	return view('Backend.Product.view_product', $data);
    }


    //Add product-------------------------------------------------------------------------
    public function add(){
    	$data['categories']= Category::all();
    	$data['brands']= Brand::all();
    	$data['colors']= Color::all();
    	$data['sizes']= Size::all();
    	return view('Backend.Product.add_product', $data);
    }

    //Store product
    public function store(Request $request){

    	DB::transaction(function() use($request){

    		$this->validate($request,[
    		'name' => 'required|unique:products,name',
    		'color_id'=> 'required',
    		'size_id'=> 'required',
    		'category_id'=> 'required',
    		'brand_id'=> 'required'
    	]);

    	$product= new Product();
    	//dd($request->all(), implode(',',$request->color_id));

    	$product->name= $request->name;
        $product->slug= str_slug($request->name);
    	$product->category_id= $request->category_id;
    	$product->brand_id= $request->brand_id;
    	// $product->color_id= $request->color_id;[If i use those field in the product table it'll show an error array to string conversation. Because those are from different table]
    	// $product->size_id= $request->size_id;
    	$product->short_desc= $request->short_desc;
    	$product->long_desc= $request->long_desc;
    	$product->price= $request->price;
    	$img= $request->file('image');

    	if($img) {
    		$imgName= date('YmdHi').$img->getClientOriginalName();
    		//$img->move(public_path('public/Upload/Product_images/'), $imgName);
    		$img->move('public/Upload/Product_images/',$imgName);
    		$product['image']= $imgName;
    	}

    	if($product->save()){
            //Sub image insert-------------------------------------------------------------------------
    		$files= $request->sub_image;

    		if(!empty($files)){
    			foreach ($files as $file) {

    				$imgName= date('YmdHi').$file->getClientOriginalName();
    				//$file->move(public_path('public/Upload/Product_images/Product_sub_images/'), $imgName);
    				$file->move('public/Upload/Product_images/Product_sub_images', $imgName);
    				$subImage['sub_image']= $imgName;

    				$subImage= new ProductSubImage();
    				$subImage->product_id= $product->id;
    				$subImage->sub_image= $imgName;
    				$subImage->save();
    			}
    		}
            //Multiple color insert---------------------------------------------------------------------
    		$colors= $request->color_id;

    		if (!empty($colors)) {
    			foreach ($colors as $color) {

    				$myColor= new ProductColor();
    				$myColor->product_id= $product->id;
    				$myColor->color_id= $color;
    				$myColor->save();
    			}
    		}
            //Multiple size insert-------------------------------------------------------------------------
    		$sizes= $request->size_id;

			if (!empty($sizes)) {
			    foreach ($sizes as $size) {
			    	
			    	$mySize= new ProductSize();
			    	$mySize->product_id= $product->id;
			    	$mySize->size_id= $size;
			    	$mySize->save();
			    }
			}  		

    	}else{
    		return redirect()->back()->with('error', 'sorry! Data not uploaded');
    	}

    	});
    	

    	return redirect()->route('products.view')->with('success','Data added successfully');

    }

    //Edit product----------------------------------------------------------------------------
    //Add and edit in under one page
    public function edit($id){

        $data['editProductData']= Product:: find($id);

        $data['categories']= Category::all();
        $data['brands']= Brand::all();
        $data['colors']= Color::all();
        $data['sizes']= Size::all();

        $data['color_array']= ProductColor::select('color_id')->where('product_id',$data['editProductData']->id)->orderBy('id', 'asc')->get()->toArray();

        $data['size_array']= ProductSize::select('size_id')->where('product_id',$data['editProductData']->id)->
            orderBy('id', 'asc')->get()->toArray();

        return view('Backend.Product.add_product', $data);
    }


    //Update product--------------------------------------------------------------------------
    public function update(ProductRequest $request, $id){

        DB::transaction(function() use($request, $id){

            $this->validate($request,[
            'color_id'=> 'required',
            'size_id'=> 'required',
        ]);

        $product= Product::find($id);

        $product->name= $request->name;
        $product->slug= str_slug($request->name);
        $product->category_id= $request->category_id;
        $product->brand_id= $request->brand_id;
        $product->short_desc= $request->short_desc;
        $product->long_desc= $request->long_desc;
        $product->price= $request->price;
        $img= $request->file('image');

        if($img) {
            $imgName= date('YmdHi').$img->getClientOriginalName();
            $img->move('public/Upload/Product_images/',$imgName);
            //Unlink photos
            if (file_exists('public/Upload/Product_images/'.$product->image) AND ! empty($product->image)) {
                unlink('public/Upload/Product_images/'.$product->image);
            }
            $product['image']= $imgName;
        }

        //Sub image update-------------------------------------------------------------------------
        if($product->save()){
        
            $files= $request->sub_image;
            //Sub images unlink
            if (!empty($files)) {
                $subImage= ProductSubImage::where('product_id', $id)->get()->toArray();
                foreach ($subImage as $value) {
                    if (!empty($value)) {
                        unlink('public/Upload/Product_images/Product_sub_images/'.$value['sub_image']);
                    }
                }
                ProductSubImage::where('product_id', $id)->delete();
            }
            //New sub images insert
            if(!empty($files)){
                foreach ($files as $file) {

                    $imgName= date('YmdHi').$file->getClientOriginalName();
                    //$file->move(public_path('public/Upload/Product_images/Product_sub_images/'), $imgName);
                    $file->move('public/Upload/Product_images/Product_sub_images', $imgName);
                    $subImage['sub_image']= $imgName;

                    $subImage= new ProductSubImage();
                    $subImage->product_id= $product->id;
                    $subImage->sub_image= $imgName;
                    $subImage->save();
                }
            }
            //Multiple color update-------------------------------------------------------------------------
            $colors= $request->color_id;

            if (!empty($colors)) {
                ProductColor::where('product_id', $id)->delete();
            }
            if (!empty($colors)) {
                foreach ($colors as $color) {

                    $myColor= new ProductColor();
                    $myColor->product_id= $product->id;
                    $myColor->color_id= $color;
                    $myColor->save();
                }
            }
            //Multiple size update-------------------------------------------------------------------------
            $sizes= $request->size_id;

            if (!empty($sizes)) {
                ProductSize::where('product_id', $id)->delete();
            }
            if (!empty($sizes)) {
                foreach ($sizes as $size) {
                    
                    $mySize= new ProductSize();
                    $mySize->product_id= $product->id;
                    $mySize->size_id= $size;
                    $mySize->save();
                }
            }       

        }else{
            return redirect()->back()->with('error', 'sorry! Data not updated');
        }

        });
        

        return redirect()->route('products.view')->with('success','Data updated successfully');
    }

    //Delete product-------------------------------------------------------------------------------
    public function delete($id){

    	$product= Product::find($id);

        if (file_exists('public/Upload/Product_images/'.$product->image) AND ! empty($product->image)) {
            unlink('public/Upload/Product_images/'.$product->image);
        }

        $subImage= ProductSubImage::where('product_id', $product->id)->get()->toArray();

        if (!empty($subImage)) {
            
            foreach ($subImage as $value) {
                if (!empty($value)) {
                    unlink('public/Upload/Product_images/Product_sub_images/'.$value['sub_image']);
                }
            }
        }

        ProductSubImage::where('product_id', $product->id)->delete();
        ProductColor::where('product_id', $product->id)->delete();
        ProductSize::where('product_id', $product->id)->delete();
        $product->delete();


    	return redirect()->route('products.view')->with('success', 'product deleted successfully');
    }


    //Product details------------------------------------------------------------------------------
    public function details($id){
        //$productColor= ProductColor::all();
        $detailsData= Product::find($id);
        return view('Backend.Product.product_details', compact('detailsData'));
    }




//Ends here
}
