<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
