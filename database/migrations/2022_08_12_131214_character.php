<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ccharacter', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('admission');

            $table->string('studied_from');
            $table->string('studied_to');
            $table->string('year_from');
            $table->string('year_to');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
