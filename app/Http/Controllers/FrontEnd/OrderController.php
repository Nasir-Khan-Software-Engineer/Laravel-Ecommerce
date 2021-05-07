<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\ShippingDetail;
use App\BillingDetail;
use App\User;
use App\Banner;
use App\Settings;
use Session;


use Auth;

use App\Mail\PhoneNotification;
use App\Mail\SendOrder;
use Illuminate\Support\Facades\Mail;


class OrderController extends Controller
{
       public function submit(Request $r){


        //customer
        $customer = Auth::user();

        // ecommerce settings
        $ecommerce_settings      = $this->ecommerce();
        $order_prefix            = $ecommerce_settings->order_prefix;
        $shipping_cost_in_dhaka  = $ecommerce_settings->shipping_cost_in_dhaka;
        $shipping_cost_out_dhaka = $ecommerce_settings->shipping_cost_out_dhaka;


        // customer info form front end
        $customer_name      = $r->name;
        $customer_email     = $r->email;
        $customer_phone     = $r->phone;
        $customer_address   = $r->address;
        $customer_note      = $r->note;

        // customer info from db / login
        $CUSTOMER_ID        = $customer->id;

        // shipping cost setup
        $order_area = $r->area;
        if($order_area == 'inside dhaka'){
            $SHIPPING_COST = $shipping_cost_in_dhaka;
        }else{
            $SHIPPING_COST = $shipping_cost_out_dhaka;
        }

        //discount
        $DISCOUNT = 0;
        if(Session::has('order-coupon')){
            $coupon         = Session::get('order-coupon');
            $coupon_id      = $coupon->id;
            $DISCOUNT       = $coupon->discount;
        }else{
            $coupon_id      = 0;
        }


        // order unique id
        // frefix+time+customer_phone
        $ORDER_CODE       = $order_prefix.time()."-".$customer_phone;

        $ORDER_SUB_TOTAL  = $r->total_cost;


        $GRAND_TOTAL_COST = $ORDER_SUB_TOTAL  + $SHIPPING_COST;
        $GRAND_TOTAL_COST = $GRAND_TOTAL_COST - $DISCOUNT;


        $TOTAL_ITEM      = $r->total_product;
        $TOTAL_QUANTITY  = $r->total_quantity;




        $order = new Order;

        $order->customer_id     = $CUSTOMER_ID;
        $order->coupon_id       = $coupon_id;
        $order->order_code      = $ORDER_CODE;
        $order->shipping_cost   = $SHIPPING_COST;
        $order->sub_total_cost  = $ORDER_SUB_TOTAL;
        $order->total_cost      = $GRAND_TOTAL_COST;
        $order->total_product   = $TOTAL_ITEM;
        $order->total_quantity  = $TOTAL_QUANTITY;
        $order->emergency_phone = $customer_phone;
        $order->customer_note   = $customer_note;
        $order->area            = $order_area;
        $order->address         = $customer_address;
        $order->save();



        $products = Session::get('cart-products');

        $order_id = $order->id;

        foreach ($products as $product) {
           $values = array(
                 'order_id' 		=> $order_id,
                 'product_id' 		=> $product['id'],
                 'product_quantity' => $product['quantity'],
                 'product_price'    => $product['price'],
                 'date' 		    => $order->created_at
          );
           DB::table('order_products')->insert($values);
        }



        //distroy session

        if(Session::has('order-coupon')){
            Session::forget('order-coupon');
        }
        Session::forget('cart-products');

        Session::flash('order-submit-message',"success");

        //clear cache
        Cache::forget('all-orders'); // clear cache




// end email to all owner
        // $data =  array(
        //     'notification_of' => "new comment",
        //     'body'            => $order->order_code;  
        // );
         
        //Mail::to("nasirkhan.webdev@gmail.com")->send(new PhoneNotification($data));
// end send email to all owner




//send email to customer
        // $order_data = array(
        //     'order'     => $order,
        //     'products'  => $products,
        //     'customer'  => $customer,
        //     'discount'  => $DISCOUNT
        // );

        // to customer
        //$customer_emal = $customer->email;
        //Mail::to("contact@gmail.com")->send(new SendOrder($order_data));
// end send email to customer


        return response()->json([
            'order' => $order
        ]);




    }

// end submit


    public function confirm(){

        //  if(!Session::has('customer')){
        //    return redirect('/');
        // }

        $customer 				= Session::get('customer');
        $order 					= Session::get('order');
        $billing 		        = Session::get('billing');
        $shipping 				= Session::get('shipping');


        Session::forget('customer');
        Session::forget('return_customer');
        Session::forget('order');
        Session::forget('billing');
        Session::forget('shipping');


        return view('public.order.confirm',compact('customer','order','billing','shipping'));
    }


}
