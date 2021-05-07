<?php

use Illuminate\Database\Seeder;
use App\About;
class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = new About;

        $about->tag = "tag";
        $about->description = "description";
        $about->about = "about";

        $about->save();
    }
}
