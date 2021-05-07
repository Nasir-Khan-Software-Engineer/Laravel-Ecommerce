<?php

use Illuminate\Database\Seeder;
use App\Offer;
class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer = new Offer;
        $offer->user_id 	= 1;
        $offer->name        = "Summer Offer";
        $offer->title       = "Dress Collection";
        $offer->slug 		= "summer-offer";
        // $offer->image       = 'offer (1).jpg';
        // $offer->type        = "%";
        // $offer->value 		= 25;
        $offer->start_time  = "12/12/2020";
        $offer->end_time 	= "1/2/2021";
        $offer->active 		= 1;
        $offer->save();


        $offer = new Offer;
        $offer->user_id     = 1;
        $offer->name 		= "Spring Offer";
        $offer->title       = "Watch Collection";
        $offer->slug 		= "spring-offer";
        // $offer->image       = 'offer (2).jpg';
        // $offer->type        = "%";
        // $offer->value 		= 30;
        $offer->start_time  = "1/2/2021";
        $offer->end_time 	= "1/5/2021";
        $offer->active 		= 1;
        $offer->save();

        $offer = new Offer;
        $offer->user_id     = 1;
        $offer->name 		= "Eid Special";
        $offer->title       = "All Collection";
        $offer->slug 		= "eid-special";
        // $offer->image       = 'offer (3).jpg';
        // $offer->type        = "tk";
        // $offer->value 		= 50;
        $offer->start_time  = "5/5/2021";
        $offer->end_time 	= "1/7/2021";
        $offer->active 		= 1;
        $offer->save();


    }
}
