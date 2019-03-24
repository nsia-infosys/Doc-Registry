<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('page_no')->nullable();
            $table->string('individual_count')->comment('Number of Individuals/Records')->nullable();
            $table->string('scan_file_status')->nullable();
            $table->string('keywords')->nullable();
            $table->string('status')->nullable();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('qc_by_id')->unsigned()->nullable();
            $table->foreign('qc_by_id')->references('id')->on('users');

            $table->timestamp('qc_date')->nullable();

            $table->timestamps();

            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books');

            $table->bigInteger('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('districts');

            $table->bigInteger('nahia_id')->unsigned()->nullable();
            $table->foreign('nahia_id')->references('id')->on('nahias');
        });

        DB::table('pages')->insert(array(
            array('id' => 1, 'book_id' => 1, 'district_id' => 1, 'nahia_id' => null, 'user_id' => 1),
            array('id' => 2, 'book_id' => 1, 'district_id' => 1, 'nahia_id' => null, 'user_id' => 1),
            array('id' => 3, 'book_id' => 1, 'district_id' => 1, 'nahia_id' => null, 'user_id' => 1)
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
