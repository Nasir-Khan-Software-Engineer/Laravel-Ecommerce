<?php

use Illuminate\Database\Seeder;
use App\Coupon;
class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
       $discount_type   = 'Tk';
       // $coupon_type  	= 'Selected Products';
       // $product_id_list = "1,2,3,4,5,6,7,8,9,10,23,24,25,45,50";
       $description 	= "Lorem ipsum dolor sit amet.";

       



       for($i=1; $i<20;$i++){

   			$coupon = new Coupon;

   	        $currentuserid  = 1;
   	        $code = "DoDo-C-".$i;
   	        $start_time  = date('Y-m-d',strtotime("+".rand(1,10)." day"));
   	        $end_time 	 = date('Y-m-d',strtotime("+".rand(11,30)." day"));

       			$coupon->code            = $code;
       			$coupon->active          = 1;
       			$coupon->start_time      = $start_time;
       			$coupon->end_time        = $end_time;
       			// $coupon->type            = $coupon_type;
       			$coupon->discount        = rand(80,100);
            $coupon->min_cost        = 200;
       			$coupon->discount_type   = $discount_type;
   	        $coupon->user_id         = $currentuserid;
   	        // $coupon->product_id_list = $product_id_list;
   	        $coupon->description 	 = $description;


   	        $coupon->save();
       }
    }
}
