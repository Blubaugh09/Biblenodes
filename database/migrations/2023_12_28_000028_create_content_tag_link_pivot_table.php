<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTagLinkPivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_tag_link', function (Blueprint $table) {
            $table->unsignedBigInteger('link_id');
            $table->foreign('link_id', 'link_id_fk_9342757')->references('id')->on('links')->onDelete('cascade');
            $table->unsignedBigInteger('content_tag_id');
            $table->foreign('content_tag_id', 'content_tag_id_fk_9342757')->references('id')->on('content_tags')->onDelete('cascade');
        });
    }
}
