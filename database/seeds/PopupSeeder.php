<?php

use Illuminate\Database\Seeder;
use App\Popup;
class PopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pupup  = new Popup;
    	$pupup->image = "1.jpg";
        $pupup->user_id = 1;
    	$pupup->active  = 0;
    	$pupup->save();

	    $pupup  = new Popup;
		$pupup->image = "2.jpg";
	    $pupup->user_id = 1;
		$pupup->active  = 0;
		$pupup->save();


    
    }
}
