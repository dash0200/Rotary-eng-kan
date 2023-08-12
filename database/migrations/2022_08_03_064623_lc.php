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
        Schema::create('lc', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('admission');

            $table->unsignedBigInteger('studied_till');
            $table->foreign('studied_till')->references('id')->on('classes');

            $table->unsignedBigInteger('till_aca_year');
            $table->foreign('till_aca_year')->references('id')->on('academic_year');

            $table->string("was_studying");
            $table->string("whether_qualified");
            
            $table->date("lt");
            $table->date("doa"); //date of application
            $table->date("doil"); //date of issuing L.C
            $table->string("reason"); //Reason for leaving school
            
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
