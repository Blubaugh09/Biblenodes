<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLinksTable extends Migration
{
    public function up()
    {
        Schema::table('links', function (Blueprint $table) {
            $table->unsignedBigInteger('from_node_id')->nullable();
            $table->foreign('from_node_id', 'from_node_fk_9342747')->references('id')->on('nodes');
            $table->unsignedBigInteger('to_node_id')->nullable();
            $table->foreign('to_node_id', 'to_node_fk_9342748')->references('id')->on('nodes');
            $table->unsignedBigInteger('user_created_id')->nullable();
            $table->foreign('user_created_id', 'user_created_fk_9342753')->references('id')->on('users');
            $table->unsignedBigInteger('affect_node_id')->nullable();
            $table->foreign('affect_node_id', 'affect_node_fk_9342758')->references('id')->on('nodes');
        });
    }
}
