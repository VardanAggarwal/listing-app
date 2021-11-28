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
            $table->enum('item_type',['input','machinery','animal','seed','produce']);
            $table->string('total_qty')->nullable();
            $table->string('min_qty')->nullable();
            $table->string('price')->nullable();
            $table->boolean('price_negotiable')->nullable();
            $table->string('logistic_terms')->nullable();
            $table->string('payment_terms')->nullable();
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
