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
use Mail;

class DashboardController extends Controller
{
    public function dashboard(){
    	
		$data['logo']= Logo::first();
		$data['contact']= Contact::first();
		
		return view('Frontend.SinglePages.customer_dashboard', $data);
    }
}
