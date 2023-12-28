<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBiblePathwaysTable extends Migration
{
    public function up()
    {
        Schema::table('bible_pathways', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9342776')->references('id')->on('users');
            $table->unsignedBigInteger('diagram_type_id')->nullable();
            $table->foreign('diagram_type_id', 'diagram_type_fk_9342783')->references('id')->on('diagram_types');
            $table->unsignedBigInteger('root_node_id')->nullable();
            $table->foreign('root_node_id', 'root_node_fk_9342784')->references('id')->on('nodes');
            $table->unsignedBigInteger('double_tree_left_node_id')->nullable();
            $table->foreign('double_tree_left_node_id', 'double_tree_left_node_fk_9342785')->references('id')->on('nodes');
            $table->unsignedBigInteger('double_tree_right_node_id')->nullable();
            $table->foreign('double_tree_right_node_id', 'double_tree_right_node_fk_9342786')->references('id')->on('nodes');
            $table->unsignedBigInteger('sankey_start_node_id')->nullable();
            $table->foreign('sankey_start_node_id', 'sankey_start_node_fk_9342787')->references('id')->on('nodes');
            $table->unsignedBigInteger('sankey_end_node_id')->nullable();
            $table->foreign('sankey_end_node_id', 'sankey_end_node_fk_9342788')->references('id')->on('nodes');
        });
    }
}
