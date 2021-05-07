<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $category_list = ['Men','Women','Kids','Boys','Girl'];

        $category_list = [
            'uncategorised',
            'boy',
            'girl',
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

        for($i=0;$i<15;$i++){
        	$cat = new Category;

        	$cat->name  = $category_list[$i];
            $cat->image = $i.'.png';
        	$cat->slug = str_replace(" ","-",strtolower($category_list[$i]));
        	$cat->user_id = 1;
            $cat->show_home = 1;
            
            if($i < 11){
                $cat->left_nav = 1;
            }
        	
        	$cat->save();
        }  
    }
}
