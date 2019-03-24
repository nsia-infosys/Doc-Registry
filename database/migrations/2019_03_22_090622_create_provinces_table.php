<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_en');
            $table->string('name_dr');
            $table->string('name_ps');

            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
        });

        DB::table('provinces')->insert(array(
            array('id' => 1, 'name_en' => 'Kabul', 'name_dr' => 'کابل', 'name_ps' => 'کابل', 'country_id' => 1),
            array('id' => 2, 'name_en' => 'Kapisa', 'name_dr' => 'کاپیسا', 'name_ps' => 'کاپیسا', 'country_id' => 1),
            array('id' => 3, 'name_en' => 'Parwan', 'name_dr' => 'پروان', 'name_ps' => 'پروان', 'country_id' => 1),
            array('id' => 4, 'name_en' => 'Wardak', 'name_dr' => 'وردک', 'name_ps' => 'وردک', 'country_id' => 1),
            array('id' => 5, 'name_en' => 'Logar', 'name_dr' => 'لوگر', 'name_ps' => 'لوگر', 'country_id' => 1),
            array('id' => 6, 'name_en' => 'Ghazni', 'name_dr' => 'غزنی', 'name_ps' => 'غزنی', 'country_id' => 1),
            array('id' => 7, 'name_en' => 'Paktya', 'name_dr' => 'پکتیا', 'name_ps' => 'پکتیا', 'country_id' => 1),
            array('id' => 8, 'name_en' => 'Nangarhar', 'name_dr' => 'ننگرهار', 'name_ps' => 'ننگرهار', 'country_id' => 1),
            array('id' => 9, 'name_en' => 'Laghman', 'name_dr' => 'لغمان', 'name_ps' => 'لغمان', 'country_id' => 1),
            array('id' => 10, 'name_en' => 'Kunar', 'name_dr' => 'کنر', 'name_ps' => 'کنر', 'country_id' => 1),
            array('id' => 11, 'name_en' => 'Badakhshan', 'name_dr' => 'بدخشان', 'name_ps' => 'بدخشان', 'country_id' => 1),
            array('id' => 12, 'name_en' => 'Takhar', 'name_dr' => 'تخار', 'name_ps' => 'تخار', 'country_id' => 1),
            array('id' => 13, 'name_en' => 'Baghlan', 'name_dr' => 'بغلان', 'name_ps' => 'بغلان', 'country_id' => 1),
            array('id' => 14, 'name_en' => 'Kunduz', 'name_dr' => 'کندوز', 'name_ps' => 'کندوز', 'country_id' => 1),
            array('id' => 15, 'name_en' => 'Samangan', 'name_dr' => 'سمنگان', 'name_ps' => 'سمنگان', 'country_id' => 1),
            array('id' => 16, 'name_en' => 'Balkh', 'name_dr' => 'بلخ', 'name_ps' => 'بلخ', 'country_id' => 1),
            array('id' => 17, 'name_en' => 'Jawzjan', 'name_dr' => 'جوزجان', 'name_ps' => 'جوزجان', 'country_id' => 1),
            array('id' => 18, 'name_en' => 'Faryab', 'name_dr' => 'فاریاب', 'name_ps' => 'فاریاب', 'country_id' => 1),
            array('id' => 19, 'name_en' => 'Badghis', 'name_dr' => 'بادغیس', 'name_ps' => 'بادغیس', 'country_id' => 1),
            array('id' => 20, 'name_en' => 'Hirat', 'name_dr' => 'هرات', 'name_ps' => 'هرات', 'country_id' => 1),
            array('id' => 21, 'name_en' => 'Farah', 'name_dr' => 'فراه', 'name_ps' => 'فراه', 'country_id' => 1),
            array('id' => 22, 'name_en' => 'Nimroz', 'name_dr' => 'نیمروز', 'name_ps' => 'نیمروز', 'country_id' => 1),
            array('id' => 23, 'name_en' => 'Hilmand', 'name_dr' => 'هلمند', 'name_ps' => 'هلمند', 'country_id' => 1),
            array('id' => 24, 'name_en' => 'Kandahar', 'name_dr' => 'کندهار', 'name_ps' => 'کندهار', 'country_id' => 1),
            array('id' => 25, 'name_en' => 'Zabul', 'name_dr' => 'زابل', 'name_ps' => 'زابل', 'country_id' => 1),
            array('id' => 26, 'name_en' => 'Uruzgan', 'name_dr' => 'اروزگان', 'name_ps' => 'اروزگان', 'country_id' => 1),
            array('id' => 27, 'name_en' => 'Ghor', 'name_dr' => 'غور', 'name_ps' => 'غور', 'country_id' => 1),
            array('id' => 28, 'name_en' => 'Bamyan', 'name_dr' => 'بامیان', 'name_ps' => 'بامیان', 'country_id' => 1),
            array('id' => 29, 'name_en' => 'Paktika', 'name_dr' => 'پکتیکا', 'name_ps' => 'پکتیکا', 'country_id' => 1),
            array('id' => 30, 'name_en' => 'Nuristan', 'name_dr' => 'نورستان', 'name_ps' => 'نورستان', 'country_id' => 1),
            array('id' => 31, 'name_en' => 'Sari Pul', 'name_dr' => 'سریپول', 'name_ps' => 'سریپول', 'country_id' => 1),
            array('id' => 32, 'name_en' => 'Khost', 'name_dr' => 'خوست', 'name_ps' => 'خوست', 'country_id' => 1),
            array('id' => 33, 'name_en' => 'Panjsher', 'name_dr' => 'پنجشیر', 'name_ps' => 'پنجشیر', 'country_id' => 1),
            array('id' => 34, 'name_en' => 'Daykundi', 'name_dr' => 'دایکندی', 'name_ps' => 'دایکندی', 'country_id' => 1)
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provinces');
    }
}
