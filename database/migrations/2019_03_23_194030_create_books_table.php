<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('book_name')->default('');
            $table->string('book_year')->nullable();
            $table->string('volume_no')->nullable();
            $table->string('start_page_no')->nullable();
            $table->string('end_page_no')->nullable();
            $table->string('total_pages')->nullable()->comment('Total number of pages');
            $table->string('keywords')->nullable();
            $table->string('status')->nullable();

            $table->bigInteger('book_type_id')->unsigned();
            $table->foreign('book_type_id')->references('id')->on('book_types');

            $table->bigInteger('province_id')->unsigned();
            $table->foreign('province_id')->references('id')->on('provinces');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger('qc_by_id')->unsigned()->nullable();
            $table->foreign('qc_by_id')->references('id')->on('users');
            
            $table->timestamp('qc_date')->nullable();

            $table->timestamps();
        });

        DB::table('books')->insert(array(
            array('id' => 1, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 2, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 3, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 4, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 5, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 6, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 7, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 8, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 9, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 10, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60),
            array('id' => 11, 'book_name' => 'Kabul', 'book_year' => '1380', 'book_type_id'=> 1, 'province_id'=>1, 'user_id'=>1, 'start_page_no'=> 1, 'end_page_no'=> 60, 'total_pages'=> 60)
        ));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
