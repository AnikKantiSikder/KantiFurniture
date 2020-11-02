<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{

    //Join product table to OrderDetail table
    public function product(){
    	return $this->belongsTo(Product::class, 'product_id','id');
    }

    //Join color table to OrderDetail table
    public function color(){
    	return $this->belongsTo(Color::class, 'color_id','id');
    }

    //Join size table to OrderDetail table
    public function size(){
    	return $this->belongsTo(Size::class, 'size_id','id');
    }
}
