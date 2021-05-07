<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Banner;
use Session;
class BannerController extends Controller
{
   public function index(){
   	 $banner = Banner::find(1);
    return view('admin.banner.index',compact('banner'));
   }


   public function update(Request $r){

   		$r->validate([
   		    'text' => 'required'
   		]);

   		$banner = Banner::find(1);

   		if ($r->hasFile('image')) {

   			//delete old base image 
   			$del = 0;
   			if(Storage::delete($banner->image)){
   				$del = 1;
   			}
   			//store new base image
   			$this_img = $r->image->store('public/images');
   			$banner->image = $this_img;
   			
   		}

   		$banner->text  = $r->text;
   		$banner->save();

         Session::forget('banner');
   		return back()->with('success','Banner Update success');


   		

   }
}
