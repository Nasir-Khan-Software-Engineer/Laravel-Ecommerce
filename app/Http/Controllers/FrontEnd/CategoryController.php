<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
  // single category
  	public function single_category(Request $r,$slug){

      

  		if($r->has('page')){
  			$page = $r->page;
  		}else{
  			$page = 1;
  		}

  		$category = Cache::rememberForever('category-'.$slug, function () use($slug){
  		    return Category::where('slug','=',$slug)->first();
  		});

  		$products = Cache::rememberForever('category-'.$slug.'-product-page-'.$page, function () use($category){
  		    return $category->products()->where('active','=',1)->orderBy('id','DESC')->simplePaginate(15);
  		});

  		
      $seo_data = array(
        'title'         => $category->name, 
        'tag'           => $category->tag, 
        'description'   => $category->description, 
      );

  		return view('public.category.single',compact('seo_data','products'));
  	}
  // end single category



    public function categories(){
      $categories = Cache::rememberForever('all-categories',function() {
          return Category::with('products')->orderBy('id','ASC')->get();
      });


      $seo_data = array(
        'title'         => "Categories", 
        'tag'           => "tag", 
        'description'   => "description", 
      );

      return view('public.category.all',compact('seo_data','categories'));
    }
}
