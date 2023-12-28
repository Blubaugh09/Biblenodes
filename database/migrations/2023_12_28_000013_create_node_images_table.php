<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodeImagesTable extends Migration
{
    public function up()
    {
        Schema::create('node_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_url')->nullable();
            $table->string('node')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
