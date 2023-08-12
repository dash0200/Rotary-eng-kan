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
        Schema::create('fee_receipt', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('admission');

            $table->bigInteger("amt_paid");
            $table->string("receipt_no")->nullable()->default(null);

            $table->unsignedBigInteger('year');
            $table->foreign('year')->references('id')->on('academic_year');

            $table->unsignedBigInteger('class');
            $table->foreign('class')->references('id')->on('classes');
            
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
