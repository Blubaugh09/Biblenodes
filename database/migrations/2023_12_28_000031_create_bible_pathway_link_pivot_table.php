<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiblePathwayLinkPivotTable extends Migration
{
    public function up()
    {
        Schema::create('bible_pathway_link', function (Blueprint $table) {
            $table->unsignedBigInteger('bible_pathway_id');
            $table->foreign('bible_pathway_id', 'bible_pathway_id_fk_9342779')->references('id')->on('bible_pathways')->onDelete('cascade');
            $table->unsignedBigInteger('link_id');
            $table->foreign('link_id', 'link_id_fk_9342779')->references('id')->on('links')->onDelete('cascade');
        });
    }
}
