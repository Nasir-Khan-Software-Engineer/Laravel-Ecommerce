<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Review;
use App\Product;
class ReviewController extends Controller
{
    public function index(){

        // order by created_at desc must coz fornt edd show form this
        $reviews = Cache::rememberForever('all-reviews',function() {
            return Review::with('product','user')->orderBy('created_at','DESC')->get();
        });

      
        return view('admin.review.index',compact('reviews'));
    }

    public function show($id){
        $review = Review::find($id);
    
    	return view('admin.review.show',compact('review'));
    }

    public function add(){
    	return view('admin.review.add');
    }

    public function edit($id){
    	return view('admin.review.edit');
    }

    public function store(Request $r){

        // delete cache reviews
        Cache::forget('all-reviews');
    	return back()->with('success','review Stored')->route('admin.index');
    }

    public function delete(Request $r){

        Review::find($r->id)->delete();


        // delete cache reviews
        Cache::forget('all-reviews');

    	return response()->json([
            'message' => "Review Deleted"
        ]);
    }

    public function active(Request $r){
        $review = Review::find($r->id);
        $review->active = !$review->active;



        // update product avg star 

        $this_product_id = $review->product->id;
        $product         = Product::find($this_product_id);

        $current_avg_rating  = $product->rating;
        $product_reviews     = $product->reviews()->where('active','=',1)->get();


        $total_star = 0;
        $total_review = 0;

        foreach ($product_reviews as $r) {
           if($r->active == 1){
                $total_star += $r->star;
                $total_review++;
           }
        }

        $review->save();

        if($review->active == 1){
            $total_star += $review->star;
            $total_review++; 
            
        }else{
            $total_star -= $review->star;
            $total_review--;    
        }

        if($total_review == 0){
            $product->rating = 0;
        }else{
            $product->rating = round($total_star / $total_review);
        }
        $product->save();


        
        Cache::forget('product-'.$product->slug);

        Cache::forget('all-reviews');

        return response()->json([
            
            'message' => "Success"
            
        ]);
       
    }



    public function seen(Request $r){
        $review = Review::find($r->id);

        $review->seen = 1;

        $review->save();
        return response()->json([
            'message' => 'Success'
        ]);
    }





}
