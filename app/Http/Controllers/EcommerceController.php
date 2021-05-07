<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Settings;
class EcommerceController extends Controller
{
    public function update(Request $r){

    	$settings = Settings::find(1);

    	$r->validate([
    		'order_prefix'                  => 'required',
            'invoice_prefix'                => 'required',
            'product_prefix'                => 'required',
            'order_notification_emails'     => 'required',
            'review_notification_emails'    => 'required',
    		
    	]);

    	$settings->order_prefix                 = $r->order_prefix;
        $settings->invoice_prefix               = $r->invoice_prefix;
        $settings->product_prefix               = $r->product_prefix;
        $settings->order_notification_emails    = $r->order_notification_emails;
        $settings->review_notification_emails   = $r->review_notification_emails;
    	

    	$settings->save();

    	return back()->with('success','Success');
    }
}
