<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
}
