<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgriservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agriservices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('charges')->nullable();
            $table->enum('type',['others','input','market','knowledge','contract_farming']);
            $table->text('terms')->nullable();
            $table->text('how_to')->nullable();
            $table->string('serviceable_locations')->nullable();
            $table->enum('target_audience',['farmers','networks']);
            $table->string('min_audience')->nullable();
            $table->foreignId('profile_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agriservices');
    }
}
