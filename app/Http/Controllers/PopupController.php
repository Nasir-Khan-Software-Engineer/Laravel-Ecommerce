<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Popup;
use Auth;
class PopupController extends Controller
{
        public function index(){
        	
        	$popups =  Cache::rememberForever('popups', function () {
        		return Popup::with('user')->get();
        	});
        	
    		return view('admin.popup.index',compact('popups'));
    	}

    	public function store(Request $r){
    		$currentuserid = Auth::user()->id;

    		$slider = new Popup;
    		$path = $this->upload_path().'/popup/';

    		$img = time().'.'.$r->image->getClientOriginalExtension();
    		$r->image->move($path, $img);

    		$slider->image = $img;
    		$slider->user_id = $currentuserid;
    		$slider->active  = 0;

    		$slider->save();

    		Cache::forget('popups');
            Cache::forget('popup-active');

    		return back()->with('success','Success');
    	}

    	public function delete(Request $r){

    		$slider = Popup::find($r->id);

    		$path = $this->upload_path().'/popup/';
    		if (File::exists($path.$slider->image)){
    		      File::delete($path.$slider->image);
    		}

    		$slider->delete();
    		Cache::forget('popups');
            Cache::forget('popup-active');

    		return response()->json([
    		   'message' => "Success"
    		]);
    	}

    	public function active(Request $r){

    		$slider = Popup::find($r->id);
    	
    		if($slider->active == 1){
    			$slider->active = 0;
    		}else{
    			$slider->active = 1;
    		}

    		$slider->save();
    		Cache::forget('popups');
            Cache::forget('popup-active');

    		return response()->json([
    			'message' => "Success"
    		]);

    		
    	}
}
