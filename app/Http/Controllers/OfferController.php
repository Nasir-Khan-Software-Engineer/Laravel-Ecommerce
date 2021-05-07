<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Offer;
use App\Product;
use Auth;

class OfferController extends Controller
{
	public function index(){
		$offers = Cache::rememberForever('all-offers',function() {
			return Offer::with('products')->orderBy('id','DESC')->get();
		});	
		return view('admin.offer.index',compact('offers'));
	}


	public function add(){

		return view('admin.offer.add');
	}

	public function edit($slug){

		    $offer = Offer::where('slug','=',$slug)->first();
		    
			return view('admin.offer.edit',compact('offer'));
	}


	public function store(Request $r){

	    
	  

	    $currentuserid  = Auth::user()->id;

	    $slug = str_replace(" ","-",strtolower($r->slug));
	    $slug = strtolower($slug);


	    $offer               = new Offer;
	    $offer->name         = $r->name;
	    $offer->title        = $r->title;
	    
	    $offer->details      = $r->details;
	    $offer->tag          = $r->tag;
	    $offer->description  = $r->description;
	    $offer->slug         = $slug;
	    $offer->user_id      = $currentuserid;

	    
	    $offer->start_time  = $r->start_time;
	    $offer->end_time 	= $r->end_time;
	    $offer->active 		= 0;

	    $offer->save();

	    Cache::flush();

		return redirect()->route('admin.offers')->with('success','Success');
	}


	public function update(Request $r){
		$currentuserid  = Auth::user()->id;
	    $offer = Offer::find($r->id);

	   	$offer->name         = $r->name;
	   	$offer->title        = $r->title;
	   	$offer->details      = $r->details;
	   	$offer->tag          = $r->tag;
	   	$offer->description  = $r->description;
	   	$offer->slug         = $r->slug;
	   	$offer->user_id      = $currentuserid;

	  
	   	$offer->start_time  = $r->start_time;
	   	$offer->end_time 	= $r->end_time;




	    $offer->save();

	    Cache::flush();
	   
		return redirect()->route('admin.offers')->with('success','Success');
	}

	public function show($slug){

	    $offer = Offer::with('products')->where('slug','=',$slug)->first();
	    $products = $offer->products()->orderBy('id','DESC')->get();
		return view('admin.offer.show',compact('offer','products'));
	}

	public function delete(Request $r){
		$offer = Offer::find($r->id);
		

		$products = $offer->products;

		foreach($products as  $product) {

		    $product->offer_id = 0;
		    $product->save();
		}

		
		
		$offer->delete();

		Cache::flush();
		return response()->json([
		     'message' => 'Success'
		]);
	}


	public function active(Request $r){

	    $id = $r->id;
	    $offer = Offer::find($id);

	    $offer->active = !$offer->active;

	    $offer->save();
	    Cache::flush();

	   return response()->json([
	      'message' => 'Success'
	   ]);

	}

}
