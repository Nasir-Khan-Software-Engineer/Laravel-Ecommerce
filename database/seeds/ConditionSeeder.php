<?php

use Illuminate\Database\Seeder;
use App\Condition;
class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condition = new Condition;

        $condition->tag = "tag";
        $condition->description = "description";
        $condition->condition = "condition";

        $condition->save();
    }
}
