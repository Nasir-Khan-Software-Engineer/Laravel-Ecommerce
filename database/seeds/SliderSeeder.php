<?php

use Illuminate\Database\Seeder;
use App\Slider;
class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        
        	$slider  = new Slider;
        	$slider->image = "1.jpg";
            $slider->title = "Winter Offer 2020";
            $slider->sub_title = "Quality Product For You";
            $slider->discription = "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to";
        	$slider->page_name = "shop page";
            $slider->link = "shop";
            $slider->user_id = 1;
        	$slider->active = 1;
        	$slider->save();

            $slider  = new Slider;
            $slider->image = "2.jpg";
            $slider->title = "Eid Offer 2021";
            $slider->sub_title = "Quality Product For You";
            $slider->discription = "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to";
            $slider->page_name = "offer page";
            $slider->link = "offer/eid-special";
            $slider->user_id = 1;
            $slider->active = 1;
            $slider->save();

            $slider  = new Slider;
            $slider->image = "3.jpg";
            $slider->title = "Bag Offer";
            $slider->sub_title = "Quality Product For You";
            $slider->discription = "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to";
            $slider->page_name = "offer page";
            $slider->link = "category/bags-&-luggage";
            $slider->user_id = 1;
            $slider->active = 1;
            $slider->save();
        
    }
}
