<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Condition;
use Illuminate\Support\Facades\Cache;
class ConditionController extends Controller
{
  


	public function index(){
		$condition = Condition::find(1);
		return view('website.pages.condition',compact('condition'));
	}

	public function edit(){
		$condition = Condition::find(1);
		return view('admin.pages.condition',compact('condition'));
	}


	public function update(Request $r){
		$condition = Condition::find(1);

		$r->validate([
		    'tag' => 'required',
		    'description' => 'required',
		    'text' => 'required'
		]);

		$condition->tag = $r->tag;
		$condition->description = $r->description;
		$condition->condition = $r->text;
		$condition->save();
		Cache::forget('condition-page');
		return back()->with('success','Terms And Condition Update Success');
	}
}
