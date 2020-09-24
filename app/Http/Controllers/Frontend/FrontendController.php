<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Logo;
use App\Model\Slider;
use App\Model\Contact;
use App\Model\About;
use App\Model\Communicate;
use Mail;

class FrontendController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

	public function index(){
		$data['logo']= Logo::first();
		$data['sliders']= Slider::all();
		$data['contact']= Contact::first();

		
		return view('Frontend.Layouts.home', $data);
	}

	//About us
	public function aboutUs(){
		$data['logo']= Logo::first();
		$data['contact']= Contact::first();
	    $data['aboutUs']= About::first();
		return view('Frontend.SinglePages.about_us', $data);
	}


	//Contact us
	public function contactUs(){
		$data['logo']= Logo::first();
		$data['contact']= Contact::first();
		
		return view('Frontend.SinglePages.contact_us', $data);
	}

	//Contact store
	public function storeContact(Request $request){
		
		$contact= new Communicate();

		$contact->name= $request->name;
		$contact->email= $request->email;
		$contact->mobile_no= $request->mobile_no;
		$contact->address= $request->address;
		$contact->msg= $request->msg;
		$contact->save();

		$data= array(
			'name'=> $request->name,
			'email'=> $request->email,
			'mobile_no'=> $request->mobile_no,
			'address'=> $request->address,
			'msg'=> $request->msg
		);

		Mail::send('Frontend.Gmails.contact', $data, function($message) use($data) {

			$message-> from('sikdermithu997@gmail.com', 'Kantisoft');
			$message-> to($data['email']);
			$message-> subject('Thanks for contacting us');
		});


		return redirect()->back()->with('success', 'Your message has been sent successfully');
	}


	//Shopping cart
	public function shoppingCart(){
		return view('Frontend.SinglePages.shopping_cart');
	}











//Ends here
}
