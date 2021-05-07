<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Category;
use App\User;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function order_index(Request $r){
    	
      if($r->exists('type')){

        Carbon::setWeekStartsAt(Carbon::SATURDAY);
        Carbon::setWeekEndsAt(Carbon::FRIDAY);

        $type = $r->type;
        

        if($type == 'this-week'){
            
          $week_start = Carbon::now()->startOfWeek();
          $week_end   = Carbon::now()->endOfWeek();

          $orders = Order::whereBetween('created_at', [$week_start,$week_end])->get();

        }else if($type =='last-week'){

        
          $last_week_start = Carbon::today()->subWeek()->addDays(-7);
          $last_week_end   = Carbon::today()->subWeek();

          $orders = Order::whereBetween('created_at', [$last_week_start,$last_week_end])->get();


        }else if($type =='today'){

          $start  = Carbon::today();
          $end    = Carbon::today();
          $orders = Order::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();

        }else if($type == 'yesterday'){
          
          $start = Carbon::yesterday();
          $end   = Carbon::yesterday();
          $orders = Order::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();


        }else if($type == 'this-month'){

          $this_month = Carbon::now()->format('m');
          $this_year  = Carbon::now()->format('Y');

          $orders = Order::whereMonth('created_at',$this_month)->whereYear('created_at',$this_year)->get();


        }else if($type == 'last-month'){

          $last_month = Carbon::now()->addMonths(-1)->format('m');
          $this_year  = Carbon::now()->format('Y');

          $orders = Order::whereMonth('created_at',$last_month)->whereYear('created_at',$this_year)->get();

        }else if($type == 'this-year'){

          $this_year  = Carbon::now()->format('Y');
          $orders = Order::whereYear('created_at',$this_year)->get();
          

          
        }else if($type == 'last-year'){
          $last_year = Carbon::now()->addYears(-1)->format('Y');

          $orders = Order::whereYear('created_at',$last_year)->get();
        }
        else{
           
          $start = $r->from;
          $end   = $r->to;
        
          $orders = Order::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();
        }


      }else{
        $orders = Order::all();
      }


    	return view('admin.report.order',compact('orders'));
    }


    public function product_index(Request $r){
      
        if($r->exists('type')){

          Carbon::setWeekStartsAt(Carbon::SATURDAY);
          Carbon::setWeekEndsAt(Carbon::FRIDAY);
          $type = $r->type;
          if($type == 'this-week'){
             $week_start = Carbon::now()->startOfWeek();
             $week_end   = Carbon::now()->endOfWeek();
             $products   = Product::whereBetween('created_at', [$week_start,$week_end])->get();
          }else if($type =='last-week'){
             $last_week_start = Carbon::today()->subWeek()->addDays(-7);
             $last_week_end   = Carbon::today()->subWeek();
             $products        = Product::whereBetween('created_at', [$last_week_start,$last_week_end])->get();
          }else if($type =='today'){
             $start     = Carbon::today();
             $end       = Carbon::today();
             $products  = Product::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();
          }else if($type == 'yesterday'){
             $start     = Carbon::yesterday();
             $end       = Carbon::yesterday();
             $products  = Product::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();
          }else if($type == 'this-month'){
             $this_month = Carbon::now()->format('m');
             $this_year  = Carbon::now()->format('Y');
             $products   = Product::whereMonth('created_at',$this_month)->whereYear('created_at',$this_year)->get();
          }else if($type == 'last-month'){
             $last_month  = Carbon::now()->addMonths(-1)->format('m');
             $this_year   = Carbon::now()->format('Y');
             $products    = Product::whereMonth('created_at',$last_month)->whereYear('created_at',$this_year)->get();
          }else if($type == 'this-year'){
             $this_year   = Carbon::now()->format('Y');
             $products    = Product::whereYear('created_at',$this_year)->get();
          }else if($type == 'last-year'){
             $last_year   = Carbon::now()->addYears(-1)->format('Y');
             $products    = Product::whereYear('created_at',$last_year)->get();
          }
          else{
             $start     = $r->from;
             $end       = $r->to;
             $products  = Product::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();
          }


        }else{
          $products = Product::all();
        }


        

        $products_data =  array();

        foreach ($products as  $product) {
            $qty = 0;
            foreach ($product->sells as  $sell) {
                $qty  += $sell->product_quantity;
            }
            $total_order =  $product->sells->count();

            $this_product = [
                'id'           => $product->id,
                'slug'         => $product->slug,
                'image'        => $product->image,
                'name'         => $product->name,
                'stock'        => $product->stock,
                'date'         => $product->created_at,
                'total_order'  => $total_order,
                'total_sell'   => $qty,
                'unit'         => $product->unit
            ];

            $products_data[] = $this_product;
        }



      return view('admin.report.product',compact('products_data'));
    }

    public function customer_index(Request $r){

      if($r->exists('type')){

        Carbon::setWeekStartsAt(Carbon::SATURDAY);
        Carbon::setWeekEndsAt(Carbon::FRIDAY);

        $type = $r->type;

        $users = User::where('type','=','customer');
        

        if($type == 'this-week'){
                
            $week_start = Carbon::now()->startOfWeek();
            $week_end   = Carbon::now()->endOfWeek();

            $customers = $users->whereBetween('created_at', [$week_start,$week_end])->get();

        }else if($type =='last-week'){

        
            $last_week_start = Carbon::today()->subWeek()->addDays(-7);
            $last_week_end   = Carbon::today()->subWeek();

            $customers = $users->whereBetween('created_at', [$last_week_start,$last_week_end])->get();


        }else if($type =='today'){

            $start  = Carbon::today();
            $end    = Carbon::today();
            $customers = $users->whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();

        }else if($type == 'yesterday'){
            
            $start = Carbon::yesterday();
            $end   = Carbon::yesterday();
            $customers = $users->whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();


        }else if($type == 'this-month'){

            $this_month = Carbon::now()->format('m');
            $this_year  = Carbon::now()->format('Y');

            $customers = $users->whereMonth('created_at',$this_month)->whereYear('created_at',$this_year)->get();


        }else if($type == 'last-month'){

            $last_month = Carbon::now()->addMonths(-1)->format('m');
            $this_year  = Carbon::now()->format('Y');

            $customers = $users->whereMonth('created_at',$last_month)->whereYear('created_at',$this_year)->get();

        }else if($type == 'this-year'){

            $this_year  = Carbon::now()->format('Y');
            $customers = $users->whereYear('created_at',$this_year)->get();
            

            
        }else if($type == 'last-year'){
            $last_year = Carbon::now()->addYears(-1)->format('Y');

            $customers = $users->whereYear('created_at',$last_year)->get();
        }
        else{

            $start = $r->from;
            $end   = $r->to;
        
            $customers = $users->whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();
        }



      }else{
         $customers = User::where('type','=','customer')->get();
      }


     
      return view('admin.report.customer',compact('customers'));
    }

    public function category_index(Request $r){

      if($r->exists('type')){

        Carbon::setWeekStartsAt(Carbon::SATURDAY);
        Carbon::setWeekEndsAt(Carbon::FRIDAY);

        $type = $r->type;
        

        if($type == 'this-week'){
                
            $week_start = Carbon::now()->startOfWeek();
            $week_end   = Carbon::now()->endOfWeek();

            $categories = Category::whereBetween('created_at', [$week_start,$week_end])->get();

        }else if($type =='last-week'){

        
            $last_week_start = Carbon::today()->subWeek()->addDays(-7);
            $last_week_end   = Carbon::today()->subWeek();

            $categories = Category::whereBetween('created_at', [$last_week_start,$last_week_end])->get();


        }else if($type =='today'){

            $start  = Carbon::today();
            $end    = Carbon::today();
            $categories = Category::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();

        }else if($type == 'yesterday'){
            
            $start = Carbon::yesterday();
            $end   = Carbon::yesterday();
            $categories = Category::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();


        }else if($type == 'this-month'){

            $this_month = Carbon::now()->format('m');
            $this_year  = Carbon::now()->format('Y');

            $categories = Category::whereMonth('created_at',$this_month)->whereYear('created_at',$this_year)->get();


        }else if($type == 'last-month'){

            $last_month = Carbon::now()->addMonths(-1)->format('m');
            $this_year  = Carbon::now()->format('Y');

            $categories = Category::whereMonth('created_at',$last_month)->whereYear('created_at',$this_year)->get();

        }else if($type == 'this-year'){

            $this_year  = Carbon::now()->format('Y');
            $categories = Category::whereYear('created_at',$this_year)->get();
            

            
        }else if($type == 'last-year'){
            $last_year = Carbon::now()->addYears(-1)->format('Y');

            $categories = Category::whereYear('created_at',$last_year)->get();
        }
        else{

            $start = $r->from;
            $end   = $r->to;
        
            $categories = Category::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();
        }


      }else{
        $categories = Category::all();
      }


      
      return view('admin.report.category',compact('categories'));
    }






    public function products_download(Request $r){

      return back();

    }
}
