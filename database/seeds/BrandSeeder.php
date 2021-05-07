<?php

use Illuminate\Database\Seeder;
use App\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$brands_list = ['Bata','Apex','DoDo','Lotto','Bay'];

		for($i=0;$i<5;$i++){
			$brands = new Brand;

			$brands->name = $brands_list[$i];
			$brands->slug = str_replace(" ","-",strtolower($brands_list[$i]));
			$brands->image = "default-brand.jpg";
			$brands->user_id = 1;
			$brands->save();
		} 
    }
}
