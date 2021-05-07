<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	public function products(){
		return $this->hasMany('App\ProductSell','order_id');
	}


	public function billing(){
		return $this->hasOne('App\BillingDetail');
	}

	public function shipping(){
		return $this->hasOne('App\ShippingDetail');
	}

	public function coupon(){
		return $this->belongsTo('App\Coupon','coupon_id');
	}

	public function customer(){
		return $this->belongsTo('App\User','customer_id');
	}

	
}
