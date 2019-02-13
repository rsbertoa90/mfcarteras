<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variant_id')->unsigned();
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->string('url');
            $table->integer('order')->default(1);
            $table->integer('row')->default(1);
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
        Schema::dropIfExists('model_images');
    }
}
