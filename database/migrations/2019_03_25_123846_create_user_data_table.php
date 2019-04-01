<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('avatar')->nullable();
            $table->json('languages')->nullable();
            $table->json('locations')->nullable();
            $table->json('contacts')->nullable();
            $table->json('services')->nullable();
            $table->text('about')->nullable();
            $table->json('user_files')->nullable();
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
        Schema::dropIfExists('user_data');
    }
}
