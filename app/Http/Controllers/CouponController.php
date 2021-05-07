<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Product;
use App\Coupon;
use Auth;
class CouponController extends Controller
{

	public function index(){
        
        $coupons = Cache::rememberForever('all-coupons',function() {
            return Coupon::orderBy('id','DESC')->get();
        });

		return view('admin.coupon.index',compact('coupons'));
	}



    public function add(){
    	
        $products = Cache::rememberForever('all-products', function () {
            return Product::orderBy('id','DESC')->get();
        });

    	return view('admin.coupon.add',compact('products'));
    }

    public function store(Request $r){
    		
       $coupon = new Coupon;

        $currentuserid  = Auth::user()->id;

        $coupon->code           = $r->code;
        $coupon->start_time     = $r->start_time;
        $coupon->end_time       = $r->end_time;
        $coupon->discount       = $r->discount;
        $coupon->min_cost       = $r->min_cost;
        $coupon->discount_type  = $r->discount_type;
        $coupon->user_id        = $currentuserid;
        $coupon->description    = $r->description;

        $coupon->save();

        // delete cache data
        $this->delete_coupos_cache();

        return back()->with('success','Success');



    }



    public function update(Request $r){


        $coupon = Coupon::find($r->id);
        $coupon->code          = $r->code;
        $coupon->start_time    = $r->start_time;
        $coupon->end_time      = $r->end_time;
        $coupon->discount_type = $r->discount_type;
        $coupon->discount      = $r->discount;
        $coupon->min_cost      = $r->min_cost;
        $coupon->description   = $r->description;

        $coupon->save();

        // delete cache data
        Cache::forget('all-coupons');

        return back()->with('success','Success');
    }



    public function show($id){
    	$coupon = Coupon::with('orders')->find($id);

    	return view('admin.coupon.show',compact('coupon'));
    }


    public function active(Request $r){

        $id = $r->id;
        $coupon = Coupon::find($id);

        $coupon->active = !$coupon->active;

        $coupon->save();
        Cache::forget('all-coupons');

       return response()->json([
          'message' => 'Success',
          'active'  => $coupon->active
       ]);

    }
    


    public function delete(Request $r){
        $coupon = Coupon::find($r->id);
        $coupon->delete();

        $this->delete_coupos_cache();
    }


    public function delete_coupos_cache(){
        Cache::forget('all-coupons');
    }




}
