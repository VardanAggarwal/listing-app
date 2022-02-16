<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertResilienciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_resiliencies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->json('data');
            $table->foreignId('profile_id')->constrained();
            $table->foreignId('resiliency_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expert_resiliencies');
    }
}
