<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTagNodePivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_tag_node', function (Blueprint $table) {
            $table->unsignedBigInteger('node_id');
            $table->foreign('node_id', 'node_id_fk_9342684')->references('id')->on('nodes')->onDelete('cascade');
            $table->unsignedBigInteger('content_tag_id');
            $table->foreign('content_tag_id', 'content_tag_id_fk_9342684')->references('id')->on('content_tags')->onDelete('cascade');
        });
    }
}
