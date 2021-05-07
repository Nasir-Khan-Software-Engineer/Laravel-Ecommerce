<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('coupon_id')->default(0);
            $table->string('order_code')->unique();
            $table->double('total_cost');
            $table->double('sub_total_cost');
            $table->integer('total_product');
            $table->integer('total_quantity');
            $table->string('emergency_phone');
            $table->string('area');
            $table->mediumText('address')->nullable();
            $table->string('status')->default('pending');
            $table->string('payment')->default('pending');
            $table->double('shipping_cost')->default(60.0);
            $table->double('payment_cost')->default(0.0);
            $table->double('process')->default(0.0);
            $table->mediumText('customer_note')->nullable();
            $table->mediumText('admin_note')->nullable();
            $table->string('completed_at')->nullable();
            $table->string('transection_id')->nullable();
            $table->boolean('seen')->default(0);
            
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
        Schema::dropIfExists('orders');
    }
}
