<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

	public function user(){
		return $this->belongsTo('App\User');
	}

    public function offer(){
        return $this->belongsTo('App\Offer');
    }


    public function categories(){
    	return $this->belongsToMany('App\Category');
    }

    public function images(){
        return $this->hasMany('App\ProductImage');
    }    

    public function colors(){
        return $this->hasMany('App\ProductColor');
    } 

    public function sizes(){
        return $this->hasMany('App\ProductSize');
    }

    public function sells(){
        return $this->hasMany('App\ProductSell','product_id');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }
}
