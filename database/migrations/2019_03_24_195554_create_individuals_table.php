<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('grand_father_name');
            $table->string('gender');
            $table->string('dob_type')->comment('Birth Date Type');
            $table->string('dob_value')->comment('Birth Date Value');
            $table->string('converted_dob')->comment('Converted Birth Date');
            $table->string('reg_date')->comment('registration date');
            $table->string('sokok_no');
            $table->string('reg_no')->comment('Registration Number');
            $table->string('file_path')->comment('Individual record cropped');
            $table->string('status');
            $table->string('record_status')->comment('Death, ID Revocation, etc');
            $table->string('kochi_winter')->comment('Winter Province ID');
            $table->string('kochi_summer')->comment('Summer Province ID');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
           
            $table->bigInteger('qc_by_id')->unsigned();
            $table->foreign('qc_by_id')->references('id')->on('users');

            $table->timestamp('qc_date')->nullable();

            $table->timestamps();

            $table->bigInteger('page_id')->unsigned();
            $table->foreign('page_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individuals');
    }
}
