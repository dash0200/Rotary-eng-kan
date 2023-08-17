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
        Schema::create('admission', function (Blueprint $table) {
            $table->id();
            $table->date("date_of_adm");

            $table->unsignedBigInteger('year');
            $table->foreign('year')->references('id')->on('academic_year');

            $table->unsignedBigInteger('caste')->nullable()->default(null);
            $table->foreign('caste')->references('id')->on('caste');
            $table->unsignedBigInteger('sub_caste')->nullable()->default(null);
            $table->foreign('sub_caste')->references('id')->on('sub_caste');
            $table->unsignedBigInteger('category');
            $table->foreign('category')->references('id')->on('categories');

            $table->unsignedBigInteger('class');
            $table->foreign('class')->references('id')->on('classes');

            $table->string("sts")->nullable()->default(null);
            $table->string("name", 50);
            $table->string("fname", 50)->nullable()->default(null);
            $table->string("mname", 50)->nullable()->default(null);
            $table->string("lname", 50)->nullable()->default(null);
            $table->string("address", 255)->nullable()->default(null);
            $table->string("city")->nullable()->default(null);
            $table->string("phone")->nullable()->default(null);
            $table->string("mobile")->nullable()->default(null);
            $table->date("dob");
            $table->string("birth_place");
            
            $table->unsignedBigInteger('sub_district')->default(null);
            $table->foreign('sub_district')->references('id')->on('sub_district');

            $table->string("religion")->nullable()->default(null);
            $table->string("nationality");
            $table->integer("gender");
            $table->boolean("handicap");
            $table->softDeletes();
            $table->string("prev_school")->nullable()->default(null);

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
