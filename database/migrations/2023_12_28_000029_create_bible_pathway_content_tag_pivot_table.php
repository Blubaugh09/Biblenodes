<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiblePathwayContentTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bible_pathway_content_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('bible_pathway_id');
            $table->foreign('bible_pathway_id', 'bible_pathway_id_fk_9342777')->references('id')->on('bible_pathways')->onDelete('cascade');
            $table->unsignedBigInteger('content_tag_id');
            $table->foreign('content_tag_id', 'content_tag_id_fk_9342777')->references('id')->on('content_tags')->onDelete('cascade');
        });
    }
}
