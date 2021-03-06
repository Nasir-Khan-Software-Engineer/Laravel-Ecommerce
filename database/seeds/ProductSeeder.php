<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProductImage;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){




	    $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea non error, perspiciatis deleniti adipisci natus a sit recusandae molestiae voluptates, illum ipsa nemo assumenda amet veniam quae minus fuga alias, accusantium, illo libero. Harum repudiandae est iusto quidem iste eum, ipsum, id, repellendus cum minus voluptates aperiam cupiditate vero, odio repellat cumque pariatur itaque maiores temporibus suscipit modi ea. Adipisci a ea nobis alias eveniet repudiandae, sequi velit, impedit repellendus eius veritatis, non natus nisi vel aliquam corporis, aut blanditiis dolore! Optio aspernatur ducimus excepturi inventore explicabo magnam suscipit, ex nobis quos doloribus fugit molestiae eligendi tenetur amet, eum veritatis!";


	    $attr = '
		    	<p><b>Color: </b></p>
				<ul>
					<li>Red</li>
					<li>Green</li>
					<li>Blue</li>
				</ul>

		    	<p><b>Size: </b></p>
				<ul>
					<li>XL</li>
					<li>M</li>
					<li>S</li>
					<li>XXL</li>
				</ul>
	    ';

	    



	    $slider_img_index = 0;





        $name = [
            'boy',
            'girls',
            'men',
            'women',
            'kids',
            'men and women',
            'mobile',
            'laptop',
            'Bags & Luggage',
            'Beauty & Bodycare',
            'Books & Stationery',
            'Construction Materials',
            'Decoration Materials',
            'Furniture',
        ];

        $image_count = 0;

        for($i=0;$i<14;$i++){

            for($j=1;$j<=6;$j++){

                $image_count++;
                
                 $product = new Product;

                
               
                 

                 $product->code              = "Ecom-P-".$i.'-'.$j;
                 $product->user_id           = 1;
                 $product->view              = 100;
                 $product->rating            = rand(2,5);
                 $product->name              = $name[$i].' Product '.$j;
                 $product->slug              = str_replace(" ","-",strtolower($name[$i].' product '.$j));
                 $product->image             = 'product ('.$image_count.').jpg';
                 $product->price             = rand(150,2000);
                 $product->old_price         = $product->price + rand(0,500);
                 $product->stock             = rand(0,150);
                 $product->description       = $description;
                 $product->attributes        = $attr;

                

                 $product->shipping_cost     = rand(50,80);
                 $product->active            = 1;
                 $product->available         = 1;

                 $product->home_show         = 1;

                 
                 $product->releted_produts_id  = "1,2,3,4,5,6,7,8,9";
                

                
                $product->offer_id = rand(1,3);
                

                 $product->save();

                  DB::table('category_product')->insert([
                     'product_id' => $product->id,
                     'category_id'=> ($i+2)
                 ]);

//====== image

                 $slider = new ProductImage;

                 $slider->product_id = $product->id;
                 $slider->image = "large-image-1.jpg";
                 $slider->save();

                 $slider = new ProductImage;

                 $slider->product_id = $product->id;
                 $slider->image = "large-image-2.jpg";
                 $slider->save();


            }
        }


    } // end function

}// end class
