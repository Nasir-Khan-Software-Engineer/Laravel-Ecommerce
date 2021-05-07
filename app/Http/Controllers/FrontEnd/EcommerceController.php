<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Product;
use App\Category;
use App\Offer;
class EcommerceController extends Controller
{
    public function shop(Request $r){

    	if($r->has('page')){
    		$page = $r->page;
    	}else{
    		$page = 1;
    	}

        $seo_data = array(
          'title'         => "Shop Now", 
          'tag'           => "shop", 
          'description'   => "shop page", 
        );

    	$products = Cache::rememberForever('shop-products-page-'.$page, function () {
    	    return Product::where('active','=',1)->orderBy('id','DESC')->simplePaginate(30);
    	});

    	return view('public.shop.index',compact('products','seo_data'));
    }


    public function shop_filter(Request $r){


        $prices = explode("-", $r->price);

       
        $from = trim($prices[0],"$ ");


       
        $to   = trim($prices[1],"$ ");

        $prices = [$from,$to];

       $seo_data = array(
         'title'         => "Products on ".$from.' to '.$to, 
         'tag'           => "shop", 
         'description'   => "shop page", 
       );

        $products = Product::whereBetween('price', $prices)->limit(24)->get();


        return view('public.product.search',compact('products','seo_data'));

        
    }

    public function offer($slug){

     

      $offer    = Offer::where('slug','=',$slug)->first();
      $products = $offer->products()->simplePaginate(18);

      

        $seo_data = array(
          'title'         => $offer->name, 
          'tag'           => $offer->tag, 
          'description'   => $offer->description,
          'details'       => $offer->details,
        );

        return view('public.offer.index',compact('seo_data','products'));

    }

}
