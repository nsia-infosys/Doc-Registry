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
            $table->string('book_number')->nullable();
            $table->string('book_type');
            $table->string('book_name')->default('');
            $table->string('assign_to_registrar')->nullable();
            $table->timestamp('assigned_date')->nullable();
            $table->string('registrar_status')->nullable();

            $table->timestamps();
        });

        DB::table('books')->insert(array(
            array('id' => 1, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 2, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 3, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 4, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 5, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 6, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 7, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 8, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 9, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 10, 'book_name' => 'Kabul', 'book_type' => 'zyx'),
            array('id' => 11, 'book_name' => 'Kabul', 'book_type' => 'zyx')
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
