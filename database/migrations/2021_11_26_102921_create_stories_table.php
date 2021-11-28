<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('overall');
            $table->text('advantages')->nullable();
            $table->text('risks')->nullable();
            $table->text('best_practices')->nullable();
            $table->text('climate_conditions')->nullable();
            $table->string('season')->nullable();
            $table->string('lifetime')->nullable();
            $table->text('infra')->nullable();
            $table->string('services')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
