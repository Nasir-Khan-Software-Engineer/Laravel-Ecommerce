<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Slider;
use App\Category;
use App\Offer;
use Auth;
class SliderController extends Controller
{
    public function index(){
    	
    	$sliders =  Cache::rememberForever('sliders', function () {
    		return Slider::with('user')->get();
    	});
    	$categories = Cache::rememberForever('all-categories',function() {
    	    return Category::with('products')->orderBy('id','DESC')->get();
    	});
    	$offers = Cache::rememberForever('all-offers',function() {
    		return Offer::with('products')->orderBy('id','DESC')->get();
    	});

		return view('admin.slider.index',compact('sliders','categories','offers'));
	}

	public function show($id){
		$slider =  Slider::with('user')->find($id);


		return view('admin.slider.show',compact('slider'));
	}

	public function store(Request $r){
		$currentuserid = Auth::user()->id;

		$slider = new Slider;
		
		
		$path = $this->upload_path().'/slider/';

		$img = time().'.'.$r->image->getClientOriginalExtension();
		$r->image->move($path, $img);



		$slider->image 			= $img;
		$slider->title 			= $r->title;
		$slider->sub_title 		= $r->sub_title;
		$slider->discription 	= $r->description;
		$slider->page_name 		= $r->page_name;

		if($r->page_name == 'shop page'){
			$slider->link = 'shop';
		}else if($r->page_name == 'category page'){
			$slider->link = "category/".$r->category;
		}else if($slider->page_name == "offer page"){
			$slider->link = "offer/".$r->offer;

		}
		$slider->user_id = $currentuserid;
		$slider->active  = 1;
		$slider->save();


		Cache::forget('sliders');
		return back()->with('success','Success');
	}

	public function delete(Request $r){

		$slider = Slider::find($r->id);


		$path = $this->upload_path().'/slider/';

		if (File::exists($path.$slider->image)){
		      File::delete($path.$slider->image);
		}

		$slider->delete();


		Cache::forget('sliders');
		return response()->json([
		   'message' => "Success"
		]);
	}

	public function active(Request $r){


		$slider = Slider::find($r->id);
		Cache::forget('sliders');

		if($slider->active == 1){
			$slider->active = 0;
			$slider->save();
			return response()->json([
				'message' => "Success"
			]);
		}else{
			$slider->active = 1;
			$slider->save();

			return response()->json([
				'message' => "Success"
			]);
		}

		
	}


}
