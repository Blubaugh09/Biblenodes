<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBookmarksTable extends Migration
{
    public function up()
    {
        Schema::table('bookmarks', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9342689')->references('id')->on('users');
            $table->unsignedBigInteger('nodes_id')->nullable();
            $table->foreign('nodes_id', 'nodes_fk_9342693')->references('id')->on('nodes');
        });
    }
}
