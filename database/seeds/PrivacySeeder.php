<?php

use Illuminate\Database\Seeder;
use App\Privacy;
class PrivacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privacy = new Privacy;

       $privacy->tag = "tag";
       $privacy->description = "description";
       $privacy->privacy = "privacy";

       $privacy->save();
    }
}
