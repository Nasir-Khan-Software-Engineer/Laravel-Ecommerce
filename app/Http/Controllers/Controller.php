<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Cache;
use App\Settings;
use App\Ecommerce;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upload_path(){
    	return public_path('assets/img');
        // return "/home/noson/ecom.nasir-khan.com/assets/img/";
    }


    public function settings(){
    	$settings = Cache::rememberForever('site-settings', function () {
    	    return Settings::find(1);
    	});
    	return $settings;
    }

    public function ecommerce(){
        $ecommerce = Cache::rememberForever('ecommerce-settings', function () {
            return Ecommerce::find(1);
        });
        return $ecommerce;
    }




}
