<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('statement_id');
            $table->integer('attachable_id');
            $table->string('attachable_type');
            $table->string('attachement_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachable');
    }
}
