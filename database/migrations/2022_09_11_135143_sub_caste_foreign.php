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
        Schema::create('sub_dist_fk', function (Blueprint $table) {
            $table->id();

            $table->string('subdist');

            $table->unsignedBigInteger('sub_district_id');
            $table->foreign('sub_district_id')->references('id')->on('sub_district');
            
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
