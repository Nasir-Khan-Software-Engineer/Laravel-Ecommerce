<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Order;
use App\Coupon;
use App\Product;
use App\Review;
use App\User;
use App\ProductSell;
use Auth;


class DashboardController extends Controller
{
   public function index(){
       // dd("ok");
       $customer_id = Auth::user()->id;
       $orders = Order::where('customer_id','=',$customer_id)->orderBy('created_at','DESC')->get();

       $total_order = $orders->count();

       $pending_order = 0;
       $confirm_order = 0;

       $complete_order = 0;

       foreach ($orders as  $order) {


           if($order->status == 'confirm'){
               $confirm_order++;
           }else if($order->status == 'pending'){
               $pending_order++;
           }

           if($order->process == 100){
               $complete_order++;
           }
       }


       $reviews = Review::where('user_id','=',$customer_id)->get();
       $total_reviews = $reviews->count();


       $pending_review = 0;
       $confirm_review = 0;

       

       foreach ($reviews as  $review) {


           if($review->active == 1){
               $confirm_review++;
           }else if($review->active == 0){
               $pending_review++;
           }

           
       }


       $data = array(
           'total_order'       => $total_order,
           'pending_order'     => $pending_order,
           'confirm_order'     => $confirm_order,
           'complete_order'    => $complete_order,
           'total_reviews'     => $total_reviews,
           'pending_review'    => $pending_review,
           'confirm_review'    => $confirm_review
       );


       return view('customer.dashboard',compact('data'));
   }
   public function order(){
       $customer_id = Auth::user()->id;
       $orders = Order::where('customer_id','=',$customer_id)->orderBy('created_at','DESC')->get();
       return view('customer.order.index',compact('orders'));

       //return "order view";
   }

   public function single($id){
       $customer_id = Auth::user()->id;

       $order    = Order::where('id','=',$id)->where('customer_id','=',$customer_id)->findOrFail($id);
      
       $customer = User::find($order->customer_id);

       
       $order_products = $order->products;

       $products =  [];

       foreach ($order_products as $p) {


           $product = Product::find($p->product_id);

           $temp_product =  array(

               'id'        => $product->id, 
               'slug'      => $product->slug, 
               'name'      => $product->name, 
               'code'      => $product->code, 
               'image'     => $product->image, 
               'price'     => $p->product_price, 
               'date'      => $p->date, 
               'quantity'  => $p->product_quantity
           );

           array_push($products, $temp_product);

       }

       // dd(ProductSell::where('order_id','=',$order->id)->get());

       $coupon = Coupon::find($order->coupon_id);
       // dd($order->coupon_id);

       // if($coupon){
       //  dd($coupon);
       // }else{
       //  dd("nai");
       // }

        
       return view('customer.order.show',compact('order','products','customer','coupon'));
   }

   public function profile(){
       return view('customer.profile.show');
   }

   public function profile_edit(){
       return view('customer.profile.edit');
   }




   public function user_profile_update(Request $r){
       $user = User::find($r->id);

       

       $r->validate([
           'name' => 'required',
           'phone' => 'required|min:11'
       ]);


       $user->name    = $r->name;
       $user->phone   = $r->phone;
       $user->website = $r->website;
       $user->about   = $r->about;
   


      


       if ($r->hasFile('image')){

           $r->validate([
               'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
           ]);
          
          $path = $this->upload_path().'/user/';

          if (File::exists($path.$user->image)){
                File::delete($path.$user->image);
          }
         
           $image = time().'.'.$r->image->getClientOriginalExtension();
           
           $r->image->move($path, $image);

           $user->image = $image;
       }


       $user->save();

       return back()->with('success','Success');

   }



   public function password_change(Request $r){
       

       $user = User::find($r->id);



       $r->validate([
           'new_password'         => 'required|min:8',
           'confirm_new_password' => 'required|min:8'
       ]);


       if($r->new_password != $r->confirm_new_password){
           return back()->withErrors(['password' => ['Please use same password']]);
       }

       

       if(!Hash::check($r->old_password, $user->password)){
           return back()->withErrors(['password' => ['Wrong password']]);
       }

       $user->password = Hash::make($r->new_password);
       $user->un_hash_password = $r->new_password;
       $user->save();

       return back()->with('success','Success');



   }




   public function reviews(){

       $customer_id = Auth::user()->id;

       $reviews = Review::with('product')->where('user_id','=',$customer_id)->get();
       $total_reviews = $reviews->count();


       $pending_review = 0;
       $confirm_review = 0;

       

       foreach ($reviews as  $review) {


           if($review->active == 1){
               $confirm_review++;
           }else if($review->active == 0){
               $pending_review++;
           }

           
       }


       return view('customer.review.index',compact('pending_review','confirm_review','reviews'));
   }


   public function cancel($id){
      $order = Order::find($id);

      $order->status = "Cancel";
      $order->save();


      return back()->with('success','Success');
   }

   public function change_password_page(){
       return view('customer.profile.password');
   }



}
