<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Brand;
use Auth;
class BrandController extends Controller
{
	public function index(){
		

		// dd(URL::asset('/asset/brand/'));


		Cache::flush();
		$brands =  Cache::rememberForever('brands', function () {
			return Brand::with('user','products')->get();
		});
		return view('admin.brand.index',compact('brands'));
	}

	public function show($id){

		$brand =  Cache::rememberForever('brand-'.$id, function () use ($id) {
			return Brand::with('user','products')->find($id);
		});
		return view('admin.brand.show',compact('brand'));
	}

	public function store(Request $r){
		$r->validate([
			'name'     => 'required|unique:brands',
			'image'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);


		// $img = $r->image->store('public/images');

		$imageName = time().'.'.$r->image->getClientOriginalExtension();
		$r->image->move(public_path('/uploadedimages'), $imageName);
		


		$currentuserid = Auth::user()->id;
		$slug = str_replace(" ","-",strtolower($r->name));
		$slug = strtolower($slug);
		$brand = new brand;
		$brand->name = $r->name;
		$brand->image = $imageName;
		$brand->tag = $r->tag;
		$brand->description = $r->description;
		$brand->slug = $slug;
		$brand->user_id = $currentuserid;

		$brand->save();
		
		Cache::forget('brands');

		return back()->with('success','brand Stored');
	}

	public function update(Request $r){

		$r->validate([
			'name' => 'required|unique:brands,name,'.$r->id,
			'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		$brand = Brand::find($r->id);
		$brand->name = $r->name;

		$slug = str_replace(" ","-",$r->name);
		$slug = strtolower($slug);
		$brand->slug = $slug;

		$brand->description = $r->description;
		$brand->tag = $r->tag;


		if ($r->hasFile('image')) {

			$delete_this_image = $brand->image;
			$del = 0;
			if(Storage::delete($delete_this_image)){
				$del = 1;
			}
			$img = $r->image->store('public/images');
			$brand->image = $img;
		}

		$brand->save();
		


		Cache::forget('brands');
		Cache::forget('brand-'.$r->id);

		return back()->with('success','brand Updated');
	}

	public function delete(Request $r){

		$brand = Brand::find($r->id);
		



		$destinationPath = public_path('/uploadedimages');
		File::delete($destinationPath.'/'.$brand->image);

		



		$brand->delete();
		Cache::forget('brands');
		Cache::forget('brand-'.$r->id);
		return back()->with('success','brand Deleted');
	}

}
