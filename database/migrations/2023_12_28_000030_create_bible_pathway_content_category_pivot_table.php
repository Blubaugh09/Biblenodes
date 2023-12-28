<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiblePathwayContentCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bible_pathway_content_category', function (Blueprint $table) {
            $table->unsignedBigInteger('bible_pathway_id');
            $table->foreign('bible_pathway_id', 'bible_pathway_id_fk_9342778')->references('id')->on('bible_pathways')->onDelete('cascade');
            $table->unsignedBigInteger('content_category_id');
            $table->foreign('content_category_id', 'content_category_id_fk_9342778')->references('id')->on('content_categories')->onDelete('cascade');
        });
    }
}
