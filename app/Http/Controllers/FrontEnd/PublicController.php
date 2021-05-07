<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use App\Product;
use App\Category;
use Session;
class PublicController extends Controller{
   
// index method start
	public function index(Request $r){


		$products = Cache::rememberForever('home-page-products', function () {
		    return Product::where('home_show','=',1)->orderBy('id','DESC')->get();
		});


		return view('public.index',compact('products'));
	}
// index method end





// shop page start
	public function shop_page(Request $r){
		return view('public.page.shop');
	}
// end shop page



// check-out page start
	public function check_out(){
		return view('public.page.check-out');
	}
// end check-out page




// contact page start
	public function contact_page(){
		return view('public.page.contact');
	}
// end contact page

// send contct email 




} // end controller
