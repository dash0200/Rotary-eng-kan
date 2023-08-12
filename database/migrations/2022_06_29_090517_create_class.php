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
        Schema::create('create_class', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('year');
            $table->foreign('year')->references('id')->on('academic_year');

            $table->unsignedBigInteger('standard');
            $table->foreign('standard')->references('id')->on('classes');

            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('admission');
            
            $table->double("total");
            $table->double("paid")->nullable()->default(0);
            $table->double("balance")->nullable()->default(0);

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
        Schema::dropIfExists('class');
    }
};
