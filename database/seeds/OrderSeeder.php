<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\Ecommerce;
use App\Product;
use App\User;
use App\Coupon;


class OrderSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $ecommerce      = Ecommerce::find(1);
        $order_prefix   = $ecommerce->order_prefix;


        for($i=0;$i<50;$i++){



        	$customer_id                = rand(13,22);
            $customer                   = User::find($customer_id);
            $customer_phone             = $customer->phone;
            $customer_address           = $customer->address;

            $order_code                 = $order_prefix.time()."-".$customer_phone.$i;
            $coupon_id                  = rand(1,19);
            $coupon                     = Coupon::find($coupon_id);
        	

        	$total_product             = rand(1,8);
        	$product_id_array          = array();
        	$product_quantity_array    = array();
            $product_price_array       = array();

        	$sub_total_cost            = 0;
        	$total_cost                = 0;
        	$total_quantity            = 0;

        	for($j=0;$j<$total_product;$j++){
        		$product_id = rand(1,35);
        		$this_product_quantity = rand(1,5);

        		array_push($product_id_array, $product_id);
        		array_push($product_quantity_array, $this_product_quantity);

        		$total_quantity += $this_product_quantity;

        		$product = Product::find($product_id);
                array_push($product_price_array, $product->price);
        		$sub_total_cost += ($product->price * $this_product_quantity);

        	}

        	$shipping_cost = 60;
            $discount      = $coupon->discount;

            if($coupon_id != 0){
        	   $total_cost    = ($sub_total_cost + $shipping_cost) - $discount;
            }else{
               $total_cost    = ($sub_total_cost + $shipping_cost);
            }


        	$emergency_phone = "0163701792".$i;

        	$status_index = rand(1,3);

        	if($status_index == 1){
        		$status       = "Pending";
        		$payment      = "Pending";
        		$payment_cost = 0;
        		$process      = 0;
        		$admin_note   = "Pending";
        	}else{
        		$status       = "Confirm";
        		$payment      = "Confirm";
        		$payment_cost = $total_cost;
        		$process      = rand(1,100);
        		$admin_note   = "Confirm";
        	}

        	$order = new Order;
        	
        	$order->customer_id        = $customer_id;
            $order->coupon_id          = $coupon_id;
        	$order->order_code         = $order_code;
        	$order->total_cost         = $total_cost;
        	$order->sub_total_cost     = $sub_total_cost;
        	$order->total_product      = $total_product;
        	$order->total_quantity     = $total_quantity;
        	$order->emergency_phone    = $emergency_phone;

        	$order->status             = $status;
        	$order->payment            = $payment;
        	$order->payment_cost       = $payment_cost;
        	$order->process            = $process;
        	$order->admin_note         = $admin_note;
            $order->area               = "inside dhaka";
            $order->address            = $customer_address;

        	
        	
        	$order->save();

        	$order_id = $order->id;


            for($k = 0; $k<sizeof($product_id_array); $k++){
                $values = array(
                    'order_id'           => $order_id,
                    'product_id'         => $product_id_array[$k],
                    'product_quantity'   => $product_quantity_array[$k],
                    'product_price'      => $product_price_array[$k],
                    'date'               => $order->created_at,
                );
                DB::table('order_products')->insert($values);
            }



        }
  		
    }
}
