<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use Illuminate\Support\Facades\Cache;
class AboutController extends Controller
{
    public function index(){
        $about = About::find(1);


    	return view('website.pages.about',compact('about'));
    	
    }

    public function edit(){
    	$about = About::find(1);
        
    	return view('admin.pages.about',compact('about'));
    }

    public function update(Request $r){
    	$about = About::find(1);

        $r->validate([
            'tag' => 'required',
            'description' => 'required',
            'text' => 'required'
        ]);

        $about->tag = $r->tag;
        $about->description = $r->description;
        $about->about = $r->text;
        $about->save();
        Cache::forget('about-page');
        return back()->with('success','About Update Success');
    }
    
}
