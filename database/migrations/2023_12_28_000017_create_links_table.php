<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label')->nullable();
            $table->string('connection_type')->nullable();
            $table->integer('weight')->nullable();
            $table->boolean('show_text_on_click')->default(0)->nullable();
            $table->string('affected_svg_state')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
