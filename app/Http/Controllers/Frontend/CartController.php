<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logo;
use App\Model\Slider;
use App\Model\Contact;
use App\Model\About;
use App\Model\Communicate;
use App\Model\Product;
use App\Model\ProductSubImage;
use App\Model\ProductColor;
use App\Model\ProductSize;
use App\Model\Size;
use App\Model\Color;
use Cart;

class CartController extends Controller
{
    public function addToCart(Request $request){
    	
    	$this->validate($request, [
    		'size_id'=> 'required',
    		'color_id'=> 'required'
    	]);

    	$product= Product:: where('id', $request->id)->first();
    	$productSize= Size::where('id', $request->size_id)->first();
    	$productColor= Color::where('id', $request->color_id)->first();

    	Cart::add([
    		'id'=> $product->id,
    		'qty'=> $request->qty,
    		'price'=> $product->price,
    		'name'=> $product->name,
    		'weight'=> 550,
    		'options' =>[
				'size_id'=> $request->size_id,
				'size_name'=> $productSize->name,
				'color_id'=> $request->color_id,
				'color_name'=> $productColor->name,
				'image'=> $product->image
    		],
    	]);

    	return redirect()->route('cart.show')->with('success','Product added successfully');
    }

    //Show cart
    public function showCart(){
    	$data['logo']= Logo::first();
		$data['contact']= Contact::first();

    	return view('Frontend.SinglePages.shopping_cart', $data);
    }


    //Update cart
    public function updateCart(Request $request){

    	Cart::update($request->rowId, $request->qty);

    	return redirect()->route('cart.show')->with('success','Product updated successfully');
    }

    //Delete cart
    public function deleteCart($rowId){

    	Cart::remove($rowId);
    	return redirect()->route('cart.show')->with('success','Product removed successfully');
    }
}
