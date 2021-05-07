<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('releted_produts_id')->default('0');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('offer_id')->default(0);
            $table->unsignedInteger('view')->default(0);
            $table->integer('rating')->default(0);
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('image');
            $table->string('unit')->default('Piece');
            $table->double('old_price')->nullable();
            $table->double('price');
            $table->integer('stock');

            // details 
            $table->mediumText('color')->nullable();
            $table->mediumText('size')->nullable();
            $table->mediumText('description');
            $table->mediumText('attributes');
            
            $table->double('discount')->default(0.0);
            $table->double('shipping_cost')->default(0.0);

            // flag
            $table->boolean('active')->default(1);
            $table->boolean('available')->default(1);
            $table->boolean('home_show')->default(0);

            //seo
            $table->mediumText('meta_description')->nullable();
            $table->mediumText('meta_keyword')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
