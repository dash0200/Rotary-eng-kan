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
        Schema::create('cstudy', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('admission');

            $table->string('from_stdy');
            $table->string('to_stdy');
            $table->string('from_year');
            $table->string('to_year');
            $table->string('mother_lang');
            $table->string('cast');
            $table->string('subcast');
            $table->string('religion');
            
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
