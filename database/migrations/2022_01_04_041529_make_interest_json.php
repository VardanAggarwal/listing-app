<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\DBAL;
class MakeInterestJson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("UPDATE interestables 
            SET interest = NULL");
        DB::statement("ALTER TABLE interestables ALTER interest TYPE JSON USING interest::json");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interestables', function (Blueprint $table) {
            $table->string('interest')->nullable()->change();
        });
    }
}
