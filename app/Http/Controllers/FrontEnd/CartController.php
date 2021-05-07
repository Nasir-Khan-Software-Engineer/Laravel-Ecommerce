<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use Session;
use App\Order;
use App\Coupon;
use Auth;
use Carbon\Carbon;
class CartController extends Controller
{
    public function add_to_cart(Request $product){


    	$message_1 = 'session age crete hoy cilo';
    	$is_it_new_product = '0';

    	//Session::flush();

    	if(!Session::has('cart-products')){
    	   $products = array();
    	   Session::put('cart-products',$products);
    	   $products = Session::get('cart-products');
    	   $message_1 = "matro session crete hoyce";
    	}else{
    	   $products = Session::get('cart-products');
    	}


    	if(!array_key_exists($product->code,$products)){
    	   
    	   $products[$product->code] = array(

    	      'id'         => intval($product->id),
    	      'code'       => $product->code,
    	      'slug'       => $product->slug,
    	      'name'       => $product->name,
            'unit'       => $product->unit,
    	      'quantity'   => intval($product->quantity),
    	      'price'      => floatval($product->price),
    	      'image'      => $product->image
          
    	   );
    	   Session::forget('cart-products');
    	   Session::put('cart-products',$products);
    	   $message_1 = $product->name." Added to your cart";
    	   $is_it_new_product = '1';

    	}else{
    	   $is_it_new_product  = '0';
    	   $message_1          = "Already add, view cart to edit";
    	}

    	return response()->json([
    	   'products'    =>$products,
    	   'message_1'   => $message_1,
    	   'new_product' => $is_it_new_product
    	]);


    }

// end add to cart



    public function delete_full_cart(){
       Session::forget('cart-products');
       $products = array();
       Session::put('cart-products',$products );

       return response()->json([
          'message' => "Cart delete succes!"
       ]);
    }

// end delete full cart



    public function create_cart(){

        if(Session::has('cart-products')){
           $products = Session::get('cart-products');
           $total_product = count($products);
        }else{
           $total_product = 0;
           $products = 'null';
        }

        return response()->json([
           'total_product' => $total_product,
           'message' => "Cart create succes!",
           'products' =>  $products

        ]);
     }
// end cart create

     // delete single product form cart 
     public function delete_cart_product(Request $r){
        $products = Session::get('cart-products');
        unset($products[$r->code]);
        Session::put('cart-products',$products);

        return response()->json([
           'message' => "Product Delete",
           'products' => $products
        ]);
     }
// end

     public function update_cart(Request $r){
        $code     = $r->code;
        $quantity = $r->quantity;

        $products = Session::get('cart-products');

        $product = $products[$code];
        // unset($products[$code]);

        $product['quantity'] = intval($quantity);
        $products[$code] = $product;

        Session::put('cart-products',$products);
        
        
        $products = Session::get('cart-products');


        return response()->json([
           
           'message' => "Cart Updare Success!",
           'products' =>  $products
           

        ]);


     }






     public function view_cart(){
     	return view('public.order.cart');
     }  

     public function check_out(){
        if (!Auth::check()) {
            return redirect()->route('website.customer.login');
        }
        return view('public.order.checkout');
     }





     public function apply_coupon(Request $r){



        $code       = $r->code;
        $total_cost = $r->total_cost;

        $coupon = Coupon::where('code','=',$code);
        
        if($coupon->count() > 0){

          $coupon   = $coupon->first();
          $min_cost = $coupon->min_cost;


          if($coupon->active == 0){
            return back()->with("coupon-message","Deactivated Coupon");
          }



          if($total_cost >= $min_cost){

            $today  = date('Y-m-d');
            $today=date('Y-m-d', strtotime($today));


            $coupon_start_date = date('Y-m-d', strtotime($coupon->start_time));
            $coupon_end_date = date('Y-m-d', strtotime($coupon->end_time));

           
            if (($today >= $coupon_start_date) && ($today <= $coupon_end_date)){
                
              Session::put('order-coupon',$coupon);

              return back()->with("coupon-message","Coupon applyed succes. You got ".$coupon->discount."Tk discount.");
              

            }else{
                return back()->with("coupon-message","Coupon date expired! Or not started yet the valid date is (".$coupon_start_date." - ".$coupon_end_date.").");
            }


          }else{

            return back()->with("coupon-message","You Need to buy more (minimum ".$min_cost." Tk) to apply this coupon.");

          }
          
 

        }else{

          return back()->with("coupon-message","Coupon Not found!");
        }
        



     }

     public function delete_coupon(Request $r){
         Session::forget('order-coupon');
         return back()->with("coupon-message","Coupon Delete Success!!");
     }

}
