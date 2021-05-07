<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Privacy;
use Illuminate\Support\Facades\Cache;
class PrivacyController extends Controller
{
   
	public function edit(){
		$privacy = Privacy::find(1);
		return view('admin.pages.privacy',compact('privacy'));
	}

	public function index(){
		$privacy = Privacy::find(1);
		return view('website.pages.privacy',compact('privacy'));
	}

	public function update(Request $r){
		$privacy = Privacy::find(1);

		$r->validate([
		    'tag' 			=> 'required',
		    'description' 	=> 'required',
		    'text'		 	=> 'required'
		]);

		$privacy->tag = $r->tag;
		$privacy->description = $r->description;
		$privacy->privacy = $r->text;
		$privacy->save();
		Cache::forget('privacy-page');
		return back()->with('success','Privacy Policy Update Success');

	}
}
