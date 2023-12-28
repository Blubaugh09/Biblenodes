<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNodeNodeMediumPivotTable extends Migration
{
    public function up()
    {
        Schema::create('node_node_medium', function (Blueprint $table) {
            $table->unsignedBigInteger('node_medium_id');
            $table->foreign('node_medium_id', 'node_medium_id_fk_9342739')->references('id')->on('node_media')->onDelete('cascade');
            $table->unsignedBigInteger('node_id');
            $table->foreign('node_id', 'node_id_fk_9342739')->references('id')->on('nodes')->onDelete('cascade');
        });
    }
}
