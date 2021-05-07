<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Review;
class ProductController extends Controller
{
    // single product start
 public function single_product($slug){



  $product = Cache::rememberForever('product-'.$slug, function () use($slug) {
      return Product::where('slug','=',$slug)->where('active','=',1)->first();
  });


  if($product == null){
    abort(404);
  }



  $sliders = $product->images;




/*
    # fetching reviews for this product from all review
    # cache value will setup in admin panel
    # for this we do not need store review again

*/
$reviews = array();
$all_reviews = Cache::rememberForever('all-reviews',function() {
    return Review::with('product','user')->orderBy('created_at','DESC')->get();
});


$total_reviews = 0;
$limited_reviews = 0;

foreach ($all_reviews  as  $review) {
    if($review->product_id == $product->id && $review->active == 1){

        $limited_reviews++;

        if($limited_reviews <= 20){
           array_push($reviews,$review);
       }

       $total_reviews++;


   }
}
// end


// dd($product->categories);

$products_id_arra = explode(",",$product->releted_produts_id);

$releted_products = Product::whereIn('id',$products_id_arra)->get();


return view('public.product.single',compact('product','reviews','releted_products','total_reviews','sliders'));
}
    // end single product


// search
public function search(Request $r){

    $keyword = $r->keyword;

    $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->limit(24)->get();


    $seo_data = array(
      'title'         => $keyword, 
      'tag'           => "search,".$keyword, 
      'description'   => "shop page", 
  );

    

    return view('public.product.search',compact('products','seo_data'));
}
// search


}
