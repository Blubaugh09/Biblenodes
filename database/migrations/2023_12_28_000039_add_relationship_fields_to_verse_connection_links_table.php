<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVerseConnectionLinksTable extends Migration
{
    public function up()
    {
        Schema::table('verse_connection_links', function (Blueprint $table) {
            $table->unsignedBigInteger('link_id')->nullable();
            $table->foreign('link_id', 'link_fk_9342761')->references('id')->on('links');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9342766')->references('id')->on('users');
        });
    }
}
