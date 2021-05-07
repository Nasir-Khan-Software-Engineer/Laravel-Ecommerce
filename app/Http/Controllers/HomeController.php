<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Category;
use App\Product;
use Auth;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        $categories = Cache::rememberForever('all-categories',function() {
            return Category::with('products')->orderBy('id','ASC')->get();
        });

        $customers = Cache::rememberForever('all-custommers',function() {
            return User::with('orders')->where('type','=','customer')->get();
        });

        $products = Cache::rememberForever('all-products', function () {
            return Product::orderBy('id','DESC')->get();
        });

        $confirm_orders  = 0;
        $pending_orders  = 0;
        $complete_orders = 0;

        $orders = Order::all();

        foreach ($orders as $order) {
           if($order->status == "Confirm"){
                $confirm_orders++;
           }else if($order->status == "Pending"){
                $pending_orders++;
           }else if($order->status == "Complete"){
                $complete_orders++;
           }    
        }
        
        

        $total_order = $complete_orders+$pending_orders+$confirm_orders;

        $order_data = [
            'confirm'  => $confirm_orders,
            'pending'  => $pending_orders,
            'complete' => $complete_orders,
            'total'    => $total_order
        ];

        $categories = $categories->count();
        $customer   =   $customers->count();



        // products data =============

        $out_of_stock_products  = 0;
        $low_stock_products     = 0;
        $total_products         = 0;


        foreach ($products as $product) {
            if($product->stock < 1){
                $out_of_stock_products++;
            }else if($product->stock > 0 && $product->stock < 10){
                $low_stock_products++;
            }
            $total_products++;
        }
        
       

        $products_data = array(
            'total_products'                => $total_products,
            'total_out_of_stock_products'   => $out_of_stock_products,
            'total_low_stock_products'      => $low_stock_products
        );

        return view('admin.dashboard',compact('order_data','customer','categories','products','products_data'));
    }
}
