<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodeTypesTable extends Migration
{
    public function up()
    {
        Schema::create('node_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shape')->nullable();
            $table->string('color')->nullable();
            $table->string('type')->nullable();
            $table->string('text_color')->nullable();
            $table->string('font_size')->nullable();
            $table->string('visibility')->nullable();
            $table->string('weight')->nullable();
            $table->string('icon_url')->nullable();
            $table->string('event')->nullable();
            $table->string('node')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
