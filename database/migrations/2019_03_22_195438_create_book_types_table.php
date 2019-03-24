<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_dr');
            $table->string('name_ps');
        });

        DB::table('book_types')->insert(array(
            array('id' => 1, 'name_en' => 'Qalamandaz', 'name_dr' => 'Qalamandaz', 'name_ps' => 'Qalamandaz'),
            array('id' => 2, 'name_en' => 'Asl-e-Asas', 'name_dr' => 'Asl-e-Asas', 'name_ps' => 'Asl-e-Asas'),
            array('id' => 3, 'name_en' => 'Motafareqa', 'name_dr' => 'Motafareqa', 'name_ps' => 'Motafareqa'),
            array('id' => 4, 'name_en' => 'Tawalodat', 'name_dr' => 'Tawalodat', 'name_ps' => 'Tawalodat'),
            array('id' => 5, 'name_en' => 'Kochi', 'name_dr' => 'Kochi', 'name_ps' => 'Kochi'),
            array('id' => 6, 'name_en' => 'Qowaey Hawayi', 'name_dr' => 'Qowaey Hawayi', 'name_ps' => 'Qowaey Hawayi'),
            array('id' => 7, 'name_en' => 'Qalamandaz', 'name_dr' => 'Qalamandaz', 'name_ps' => 'Qalamandaz'),
            array('id' => 8, 'name_en' => 'PMU (Motafareqa)', 'name_dr' => 'PMU (Motafareqa)', 'name_ps' => 'PMU (Motafareqa)'),
            array('id' => 9, 'name_en' => 'Motafareqa Wolayat (Kabul)', 'name_dr' => 'Motafareqa Wolayat (Kabul)', 'name_ps' => 'Motafareqa Wolayat (Kabul)')
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_types');
    }
}
