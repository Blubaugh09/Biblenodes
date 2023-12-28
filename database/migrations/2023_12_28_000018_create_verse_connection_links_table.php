<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerseConnectionLinksTable extends Migration
{
    public function up()
    {
        Schema::create('verse_connection_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('verse')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
