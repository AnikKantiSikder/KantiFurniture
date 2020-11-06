<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Shipping;
use App\Model\Payment;
use App\Model\Order;
use App\Model\OrderDetail;
use App\User;
use DB;
use Auth;

class OrderController extends Controller
{
    //Customer pending list
    public function pendingList(){

        $data['orders']= Order::where('status','0')->get();
        return view('Backend.Order.customer_pending_list', $data);
    }


    //Customer approved list
    public function approvedList(){

        $data['orders']= Order::where('status','1')->get();
        return view('Backend.Order.customer_approved_list', $data);
    }

    //Order details
    public function details($id){

   		$data['order']= Order::find($id);
        return view('Backend.Order.order_details', $data);
    }

    //Approve customer approval
    public function approveOrder(Request $request){

    	$order= Order::find($request->id);
    	$order->status= '1';
    	$order->save();
    	return redirect()->back();
    }
}
