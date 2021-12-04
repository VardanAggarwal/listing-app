<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->enum('type',['buy','sell']);
            $table->enum('item_type',['input','machinery','animal','seed','produce','training','contract_farming']);
            $table->string('image_url')->nullable();
            $table->json('media')->nullable();
            $table->string('price')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->date('expiry')->nullable();
            $table->json('additional_info')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
