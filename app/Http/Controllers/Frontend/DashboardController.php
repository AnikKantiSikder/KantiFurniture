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
use App\Model\Shipping;
use App\Model\Payment;
use App\Model\Order;
use App\Model\OrderDetail;
use App\User;
use Session;
use Cart;
use Mail;
use Auth;
use DB; 

class DashboardController extends Controller
{

    //View customer dashboard
    public function dashboard(){
        
        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        $data['userData']= Auth::user();
        
        return view('Frontend.SinglePages.customer_dashboard', $data);
    }

    //Customer edit profile
    public function editProfile(){

        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        $data['editData']= User::find(Auth::user()->id);
        
        return view('Frontend.SinglePages.customer_edit_profile', $data);
    }

    //Customer update profile
    public function updateProfile(Request $request){

        $user= User::find(Auth::user()->id);
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|unique:users,email,'.$user->id,
            'mobile'=> ['required','unique:users,mobile,'.$user->id,
            'regex:/(^(\+8801|8801|008801))[1|5-9]{1}(\d){8}$/'],
        ]);

        $user->name= $request->name;
        $user->email= $request->email;
        $user->mobile= $request->mobile;
        $user->address= $request->address;
        $user->gender= $request->gender;

        if($request->file('image')){
            $file= $request->file('image');
            @unlink(public_path('Upload/User_images/'.$user->image));
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('Upload/User_images'), $filename);
            $user['image']= $filename;
        }

        // return response()->json($user);
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully');

    }

    //Customer password change
    public function passwordChange(){

        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        $data['editData']= User::find(Auth::user()->id);
        
        return view('Frontend.SinglePages.customer_password_change', $data);
    }


    //Customer password update
    public function passwordUpdate(Request $request){

        if(Auth::attempt(['id'=> Auth::user()->id, 'password'=>$request->current_password])){

            $user= User::find(Auth::user()->id);
            $user->password= bcrypt($request->new_password);
            $user->save();
            return redirect()->route('dashboard')->with('success', 'Password updated successfully');
        }
        else{
            return redirect()->back()->with('error', 'Sorry! your current password does not match');
        }
    }

    //Payment
    public function payment(){

        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        
        return view('Frontend.SinglePages.customer_payment', $data);

    }

    //Customer payment store
    public function paymentStore(Request $request){
        if ($request->product_id == NULL) {
            return redirect()->back()->with('message', 'Please add any product first');
        }
        else{

        $this->validate($request, [
            'payment_method'=> 'required'
        ]);

        if ($request->payment_method == 'Bkash' && $request->transaction_no == NULL) {
            return redirect()->back()->with('message', 'Please provide your Bkash transation number');
        }

        DB::transaction(function() use($request){

            $payment= new Payment();
            $payment->payment_method= $request->payment_method;
            $payment->transaction_no= $request->transaction_no;

            $payment->save();

            $order= new Order();
            $order->user_id= Auth::user()->id;
            $order->shipping_id= Session::get('shipping_id');
            $order->payment_id= $payment->id;
            $order_data= Order::orderBy('id', 'desc')->first();
            if($order_data == null){
                $firstReg= '0';
                $order_no= $firstReg+1;
            }else{
                $order_data= Order::orderBy('id', 'desc')->first()->order_no;
                $order_no= $order_data+1;
            }
            $order->order_no= $order_no;
            $order->order_total= $request->order_total;
            $order->status= '0';

            $order->save();

            $contents= Cart::content();
            foreach ($contents as $content) {

                $order_details= new OrderDetail();
                $order_details->order_id= $order->id;
                $order_details->product_id= $content->id;
                $order_details->color_id= $content->options->color_id;
                $order_details->size_id= $content->options->size_id;
                $order_details->quantity= $content->qty;
                $order_details->save();
            }
            
        });
        //Else ends
        }
        

        Cart::destroy();
        
        return redirect()->route('customer.order.list')->with('success', 'Your orders received successfully');

    }

    //Customer order list
    public function orderList(){

        $data['logo']= Logo::first();
        $data['contact']= Contact::first();
        $data['orders']= Order::where('user_id', Auth::user()->id)->get();
        
        return view('Frontend.SinglePages.customer_order_list', $data);
    }

    //Customer order details
    public function orderDetails($id){

        $orderData= Order::find($id);
        $data['order']= Order::where('id', $orderData->id)->where('user_id',Auth::user()->id)->first();


        if ($data['order'] == false) {
            return redirect()->back()->with('Error','Do not try to be oversmart');
        }else{

            $data['logo']= Logo::first();
            $data['contact']= Contact::first();
            $data['order']= Order::with(['order_details'])->where('id', $orderData->id)->where('user_id',Auth::user()->id)->first();
            return view('Frontend.SinglePages.customer_order_details', $data);
        }
    }

    //Customer order print
    public function orderPrint($id){

        $orderData= Order::find($id);
        $data['order']= Order::where('id', $orderData->id)->where('user_id',Auth::user()->id)->first();


        if ($data['order'] == false) {
            return redirect()->back()->with('Error','Do not try to be oversmart');
        }else{

            $data['logo']= Logo::first();
            $data['contact']= Contact::first();
            $data['order']= Order::with(['order_details'])->where('id', $orderData->id)->where('user_id',Auth::user()->id)->first();
            return view('Frontend.SinglePages.customer_order_print', $data);
        }
    }



//Ends here
}

