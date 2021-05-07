<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use Illuminate\Support\Facades\Cache;
class CategoryController extends Controller
{
    public function index(){

        $categories = Cache::rememberForever('all-categories',function() {
            return Category::with('products')->orderBy('id','ASC')->get();
        });

        return view('admin.category.index',compact('categories'));
    }

    public function show($slug){

        $category = Category::with('products','user')->where('slug','=',$slug)->first();
        $products = $category->products()->orderBy('id','DESC')->get();
        return view('admin.category.show',compact('category','products'));
    }

    public function store(Request $r){


        $r->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $image = time().'.'.$r->image->getClientOriginalExtension();
        $path = $this->upload_path().'/category/';
        $r->image->move($path, $image);

        $currentuserid  = Auth::user()->id;

        $slug = str_replace(" ","-",strtolower($r->name));
        $slug = strtolower($slug);


        $category               = new Category;
        $category->name         = $r->name;
        $category->image        = $image;
        $category->tag          = $r->tag;
        $category->description  = $r->description;
        $category->slug         = $slug;
        $category->user_id      = $currentuserid;


        if($r->relation == "parent"){
            $category->parent_id = 0;
        }else{
            $category->parent_id = $r->parent;
        }



        $category->save();

        Cache::forget('all-categories');

        return back()->with('success','Success');
    }

    public function update(Request $r){

        $r->validate([
            'name' => 'required|unique:categories,name,'.$r->id,
        ]);

        $category = Category::find($r->id);
        $category->name = $r->name;

        $slug = str_replace(" ","-",$r->name);
        $slug = strtolower($slug);
        $category->slug = $slug;

        $category->description = $r->description;
        $category->tag = $r->tag;



        if($r->relation == "parent"){
            $category->parent_id = 0;
        }else{
            $category->parent_id = $r->parent;
        }



        if ($r->hasFile('image')) {

            $delete_this_image = $category->image;

            $path = $this->upload_path().'/category/';
            if (File::exists($path.$category->image)){
                  File::delete($path.$category->image);
            }

            $img = time().'.'.$r->image->getClientOriginalExtension();
            $r->image->move($path, $img);
            $category->image = $img;

        }



        $category->save();


        Cache::forget('all-categories');

        return back()->with('success','Success');
    }

    public function delete(Request $r){

       $category = Category::find($r->id);

       


       if($category->id == 1){
         return response()->json([
             'message' => 'Default Category!'
         ]);
       }

       $path = $this->upload_path().'/category/';
       if (File::exists($path.$category->image)){
             File::delete($path.$category->image);
       }
       

    
       $products = $category->products;

       foreach($products as  $product) {

            DB::table('category_product')->insert([
               'product_id' => $product->id,
               'category_id'=> 1
           ]);
       }

       DB::table('category_product')->where('category_id',$r->id)->delete();

       $category->delete();

       Cache::flush();

       return response()->json([
            'message' => 'Success'
       ]);
   }

   public function show_home(Request $r){

    $id = $r->id;
    $category = Category::find($id);

    $category->show_home = !$category->show_home;

    $category->save();

    Cache::forget('all-categories');

    return response()->json([
      'message' => 'Success'
  ]);

}

   public function left_nav(Request $r){

        $id = $r->id;
        $category = Category::find($id);

        $category->left_nav = !$category->left_nav;

        $category->save();

        Cache::forget('all-categories');

        return response()->json([
          'message' => 'Success'
      ]);

    }


public function download(){
    $categories = Category::with('products')->orderBy('id','DESC')->get();

    $categories_data =  array();

    foreach ($categories as  $category) {
        $products = $category->products->count() ;
        $this_category = [

            'name'  => $category->name,
            'total_product'  =>$products,
            'Date'  =>$category->created_at->format('d-m-Y'),
        ];
        $categories_data[] = $this_category;
    }

    $filename = 'Data_Categories_'.date("l_d_m_Y").'.csv';       
    header("Content-type: text/csv");       
    header("Content-Disposition: attachment; filename=$filename");       
    $output = fopen("php://output", "w");

    $header = ['Name','Total Products','Date'];
    fputcsv($output, $header);
    $header = ['','',''];
    fputcsv($output, $header);  

    foreach($categories_data as $category)       
    {  
        fputcsv($output, $category);  
    }       
    fclose($output); 
}

}
