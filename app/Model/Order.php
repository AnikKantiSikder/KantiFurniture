<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	//Join paymet table to order table
    public function payment(){
    	return $this->belongsTo(Payment::class, 'payment_id','id');
    }

    //Join shipping table to order table

    public function shipping(){
    	return $this->belongsTo(Shipping::class, 'shipping_id','id');
    }

    //Join shipping table to order table

    public function order_details(){
    	return $this->hasMany(OrderDetail::class, 'order_id','id');
    }
}
