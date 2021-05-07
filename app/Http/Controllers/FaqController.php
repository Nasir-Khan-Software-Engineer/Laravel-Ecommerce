<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Faq;
use Auth;
class FaqController extends Controller
{
    public function index(){
    	$faqs = Cache::rememberForever('faqs',function(){
    		return Faq::with('user')->get();
    	});
    	return view('admin.faq.index',compact('faqs'));
    }

    public function store(Request $r){

    	$r->validate([
    	    'question' => 'required',
    	    'ans' => 'required'
    	]);


    	$currentuserid = Auth::user()->id;
    	$faq = new Faq;
    	$faq->question  = $r->question;
    	$faq->ans = $r->ans;
    	$faq->user_id = $currentuserid;
    	$faq->save();
    	Cache::forget('faqs');
    	return back()->with('success','Success');
    }

    public function show($id){
    	
    	$faq =  Cache::rememberForever('faq-'.$id, function () use ($id) {
    		return Faq::with('user')->find($id);
    	});
    	return view('admin.faq.show',compact('faq'));
    }

    public function update(Request $r){

    	$r->validate([
    		'question' => 'required',
    		'ans'      => 'required'
    	]);

    	$faq           = Faq::find($r->id);
    	$faq->question = $r->question;
    	$faq->ans      = $r->ans;

    	$faq->save();
    	Cache::forget('faqs');
    	Cache::forget('faq-'.$r->id);

    	return back()->with('success','Success');
    }

    public function delete(Request $r){

    	$faq = Faq::find($r->id);
    	$faq->delete();

    	Cache::forget('faqs');
    	Cache::forget('faq-'.$r->id);

    	return back()->with('success','Success');
    }

}
