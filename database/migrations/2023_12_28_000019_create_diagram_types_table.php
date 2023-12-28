<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagramTypesTable extends Migration
{
    public function up()
    {
        Schema::create('diagram_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('specialty_field')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
