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
use App\Model\Shipping;
use App\Model\Payment;
use App\Model\Order;
use App\Model\OrderDetail;
use Cart;
use App\User;
use DB;
use Mail;
use Auth;
use Session;


class CheckoutController extends Controller
{
    public function customerLogin(){

    	$data['logo']= Logo::first();
		$data['contact']= Contact::first();
    	return view('Frontend.SinglePages.customer_login', $data);
    }


    //Customer sign up
     public function customerSignup(){

    	$data['logo']= Logo::first();
		$data['contact']= Contact::first();
    	return view('Frontend.SinglePages.customer_signup', $data);
    }

    //Customer signup store
    public function signupStore(Request $request){
        
        DB::transaction(function() use($request){
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|unique:users,email',
            'mobile'=> ['required','unique:users,mobile','regex:/(^(\+8801|8801|008801))[1|5-9]{1}(\d){8}$/'],
            'password'=> 'min:8|required_with:confirmation_password|same:confirmation_password',
            'confirmation_password'=> 'min:8'

            ]);
        });

        $verificaitonCode= rand(0000,9999);

        $user= new User();

        $user->name= $request->name;
        $user->email= $request->email;
        $user->mobile= $request->mobile;
        $user->password= bcrypt($request->password);
        $user->verification= $verificaitonCode;
        $user->status= '0';
        $user->user_type= 'customer';
        $user->save();

        $data= array(
            'email'=> $request->email,
            'verification'=> $verificaitonCode
        );

        Mail::send('Frontend.Gmails.verify_email', $data, function($message) use($data) {

            $message-> from('sikdermithu997@gmail.com', 'Kantifurniture');
            $message-> to($data['email']);
            $message-> subject('Please verify your email address');
        });


        return redirect()->route('email.verify')->with('success', 'Your have succesfully signed up.Please verify your email !');
    }

    //Customer email verification
    public function emailVerify(){

        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        return view('Frontend.SinglePages.email_verify', $data);
    }


    //Customer email verification store
    public function storeVerification(Request $request){

        $this->validate($request, [
            'email'=> 'required',
            'verificaiton'=> 'required',
        ]);

        $checkData= User::where('email', $request->email)->where('verification', $request->verificaiton)->first();

        if($checkData){
            
            $checkData->status= '1';
            $checkData->save();
            return redirect()->route('customer.login')->with('success', 'You have successfully verified.Please log in');
        }
        else{
            return redirect()->back()->with('error','Sorry! Email or verificaiton code does not match');
        }
    }

    //Customer checkout
    public function checkout(){
        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        return view('Frontend.SinglePages.customer_checkout', $data);
    }

    //Customer checkout store
    public function checkoutStore(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'mobile'=> 'required',
            'address'=> 'required',
        ]);

        $checkout= new Shipping();

        $checkout->user_id= Auth::user()->id;
        $checkout->name= $request->name;
        $checkout->email= $request->email;
        $checkout->mobile= $request->mobile;
        $checkout->address= $request->address;

        $checkout->save();
        Session::put('shipping_id', $checkout->id);

        return redirect()->route('customer.payment')->with('success', 'Data saved successfully');


    }


//Ends here
}
