<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNotesTable extends Migration
{
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9342703')->references('id')->on('users');
            $table->unsignedBigInteger('node_related_to_id')->nullable();
            $table->foreign('node_related_to_id', 'node_related_to_fk_9342708')->references('id')->on('nodes');
        });
    }
}
