<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerseConnectionsTable extends Migration
{
    public function up()
    {
        Schema::create('verse_connections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('verses')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
