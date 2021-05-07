<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{


	public function __construct(){   
	    $this->middleware('guest')->except('logout');
	}


    public function registration(){
    	return view('public.auth.register');
    }

    public function login(){
    	return view('public.auth.login');
    } 

    public function password_reset(){
    	return view('public.auth.passwords.reset');
    }
}
