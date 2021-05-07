<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserSeeder::class);
         $this->call(CustomerSeeder::class);
         $this->call(SettingsSeeder::class);
         $this->call(EcommerceSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(BrandSeeder::class);
         $this->call(SliderSeeder::class);
         $this->call(ProductSeeder::class);
         $this->call(ReviewSeeder::class);
         $this->call(FaqSeeder::class);
         $this->call(CouponSeeder::class);
         $this->call(OrderSeeder::class);
         $this->call(EmailSeeder::class);
         $this->call(AboutSeeder::class);
         $this->call(PrivacySeeder::class);
         $this->call(ConditionSeeder::class);
         $this->call(OfferSeeder::class);
         $this->call(PopupSeeder::class);
    }
}
