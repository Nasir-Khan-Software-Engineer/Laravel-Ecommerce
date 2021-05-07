<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->default(1);
            $table->string('name');
            $table->string('title');
            // $table->string('image');
            $table->string('slug');
            // $table->string('type');
            // $table->integer('value');
            $table->string('start_time');
            $table->string('end_time');
            $table->boolean('active')->default(0);
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->text('tag')->nullable();
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
        Schema::dropIfExists('offers');
    }
}
