<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodeVerseConnectionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('node_verse_connection', function (Blueprint $table) {
            $table->unsignedBigInteger('verse_connection_id');
            $table->foreign('verse_connection_id', 'verse_connection_id_fk_9342732')->references('id')->on('verse_connections')->onDelete('cascade');
            $table->unsignedBigInteger('node_id');
            $table->foreign('node_id', 'node_id_fk_9342732')->references('id')->on('nodes')->onDelete('cascade');
        });
    }
}
