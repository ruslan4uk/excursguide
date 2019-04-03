<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->text('avatar')->nullable();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('route')->nullable();
            $table->json('languages')->nullable();
            $table->integer('category')->nullable();
            $table->integer('people_category')->nullable();
            $table->integer('people_count')->nullable();
            $table->string('timing')->nullable();
            $table->integer('price')->nullable();
            $table->integer('currency')->default(643);
            $table->integer('price_type')->default(1);
            $table->string('services')->nullable();
            $table->string('other_rate')->nullable();
            $table->string('other_item')->nullable();
            $table->string('about')->nullable();
            $table->json('photo')->nullable();
            $table->string('active')->default(0);
            $table->string('status')->default(0);
            $table->json('properties')->nullable();
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
        Schema::dropIfExists('tours');
    }
}
