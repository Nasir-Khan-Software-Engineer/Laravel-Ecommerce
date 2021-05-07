<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(){
    	return view('admin.package.index');
    }

    public function show($id){
    	return view('admin.package.show');
    }

    public function add(){
    	return view('admin.package.add');
    }

    public function edit($id){
    	return view('admin.package.edit');
    }

    public function store(Request $r){
    	return back()->with('success','package Stored')->route('admin.index');
    }

    public function delete(Request $r){
    	return back()->with('success','package Deleted')->route('admin.index');
    }

    public function active(Request $r){
    	return back()->with('success','package Activated');
    }
    public function deactivated(){
    	return back()->with('success','package Deactivated');
    }

}
