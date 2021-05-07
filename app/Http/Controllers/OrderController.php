<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;
use App\Coupon;
use Auth;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function index(){
       
        $orders = Order::orderBy('seen','ASC')->orderBy('created_at','ASC')->get();
        return view('admin.order.index',compact('orders'));
    	
    }

    public function show($id){


     
        $order = Cache::rememberForever('order-id-'.$id,function()use($id) {
            return Order::with('customer','products','coupon')->find($id);
        });

        
        $customer       = $order->customer;
        $order_products = $order->products;

        $products =  [];

        foreach ($order_products as $p) {

            $product = Product::find($p->product_id);
           
            $temp_product =  array(

                'id'                => $product->id, 
                'slug'              => $product->slug, 
                'name'              => $product->name, 
                'code'              => $product->code, 
                'image'             => $product->image, 
                'price'             => $p->product_price, 
                'date'              => $p->date, 
                'quantity'          => $p->product_quantity,
                'currnt_stock'      => $product->stock
            );

            array_push($products, $temp_product);

        }

        $coupon = $order->coupon;
        
        return view('admin.order.show',compact('order','products','customer','coupon'));


    }


    public function invoice($id){


        $order = Cache::rememberForever('order-id-'.$id,function()use($id) {
            return Order::with('customer','products','coupon')->find($id);
        });

        $customer        = $order->customer;
        $order_products  = $order->products;

        $products =  [];

        foreach ($order_products as $p) {

            $product = Product::find($p->product_id);
        
            $temp_product =  array(
                'name'              => $product->name, 
                'code'              => $product->code, 
                'image'             => $product->image, 
                'price'             => $p->product_price, 
                'date'              => $p->date, 
                'quantity'          => $p->product_quantity,
            );

            array_push($products, $temp_product);
        }
        
        $coupon = $order->coupon;
         
        return view('admin.order.invoice',compact('order','products','customer','coupon'));
    }



    public function update(Request $r){
        $id = $r->id;
        
        $order = Cache::rememberForever('order-id-'.$id,function()use($id) {
            return Order::with('customer','products','coupon')->find($id);
        });

        $order->payment         = $r->payment_status;
        $order->admin_note      = $r->admin_note;
        $order->status          = $r->order_status;
        $order->process         = $r->order_processing_percentage;
        $order->payment_cost    = $r->payment_cost;

        $order->save();

        Cache::forget('order-id-'.$id);

        Cache::rememberForever('order-id-'.$id,function()use($order) {
            return $order;
        });

    	return back()->with('success','Success');
    }



    public function accept_product(Request $r){
    	$order         = Order::find($r->order_id);
        
        $product       = Product::find($r->product_id);
        $customer_qty  = $r->customer_qty;
        $action        = $r->action;

        if($action == "cancel"){

            $coupon       = Coupon::find($order->coupon_id);

            $price = $product->price * $customer_qty;

            $current_sub_total   = $order->sub_total_cost - $price;
            $shipping_cost       = $order->shipping_cost;

            if($order->coupon_id > 0){

                $minimum_cost = $coupon->min_cost;

                if($current_sub_total < $minimum_cost){
                    $order->coupon_id = 0; 
                    $discount         = 0;
                }else{
                    $discount         = $coupon->discount;
                }

            }else{
                 $discount = 0;
            }


            $order->sub_total_cost = $current_sub_total;
            $order->total_cost     = ($current_sub_total + $shipping_cost) - $discount;
           
            



            DB::table('order_products')->where('order_id','=', $r->order_id)->where('product_id','=',$r->product_id)->delete();

            $order->admin_note = $order->admin_note." | Sorry Your ".$customer_qty." ".$product->unit." ".$product->name." Not Accepted";
            $order->save();


        }else if($action == "accept"){
            $product->stock = $product->stock - $customer_qty;

            $order->admin_note = $order->admin_note." | Your ".$customer_qty." ".$product->unit." ".$product->name." Accepted";
            $order->save();
            $product->save();
        }

        return back()->with('success','Success');
    }   


    public function store(Request $r){
        return back()->with('success','Order Stored')->route('admin.index');
    }

    public function delete(Request $r){

        $id = $r->id;
        
        Order::find($id)->delete();
        BillingDetail::where('order_id','=',$id)->delete();
        ShippingDetail::where('order_id','=',$id)->delete();
        DB::table('order_products')->where('order_id', $id)->delete();
        
    	// return back()->with('success','Order Deleted');

        return response()->json([
            'message' => 'Success'
        ]);
    }


    public function active(Request $r){
    	return back()->with('success','Order Activated');
    }
    public function deactivated(){
    	return back()->with('success','Order Deactivated');
    }

    public function seen(Request $r){
        $order = Order::find($r->id);

        $order->seen = 1;

        $order->save();
        return response()->json([
            'message' => 'Success'
        ]);
    }






    public function download(){


        $filename = 'Data_Products_'.date("l_d_m_Y").'.csv';       
        header("Content-type: text/csv");       
        header("Content-Disposition: attachment; filename=$filename");       
        $output = fopen("php://output", "w");

        $header = [
            'Code',
            'Total Cost',
            'Sub Total Cost',
            'Total Product',
            'Total Quantity',
            'Status',
            'Payment',
            'Payment Cost',
            'Process',
            'Date'
        ];
        fputcsv($output, $header);
        $header = ['','','','','','','','',''];
        fputcsv($output, $header); 


        $orders = Order::orderBy('created_at','DESC')->get();

        foreach ($orders as  $order) {
           
            $this_order = [
               
                'code'              =>$order->order_code,
                'total_cost'        =>$order->total_cost.'Tk',
                'sub_total_cost'    =>$order->sub_total_cost.'Tk',
                'total_product'     =>$order->total_product,
                'total_quantity'    =>$order->total_quantity,
                'status'            =>$order->status,
                'payment'           =>$order->payment,
                'payment_cost'      =>$order->payment_cost.'Tk',
                'process'           =>$order->process."%",
                'Date'              =>$order->created_at->format('d-m-Y')
            ];
           
            fputcsv($output, $this_order); 
        }
             
        fclose($output); 
    } // end download




}
