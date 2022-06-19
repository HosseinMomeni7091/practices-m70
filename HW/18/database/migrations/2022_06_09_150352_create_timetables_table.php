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
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string("day");
            $table->integer("91");
            $table->integer("92");
            $table->integer("93");
            $table->integer("94");
            $table->integer("95");
            $table->integer("96");
            $table->integer("97");
            $table->integer("98");
            $table->integer("99");
            $table->integer("910");
            $table->integer("911");
            $table->integer("912");
            $table->integer("101");
            $table->integer("102");
            $table->integer("103");
            $table->integer("104");
            $table->integer("105");
            $table->integer("106");
            $table->integer("107");
            $table->integer("108");
            $table->integer("109");
            $table->integer("1010");
            $table->integer("1011");
            $table->integer("1012");
            $table->integer("111");
            $table->integer("112");
            $table->integer("113");
            $table->integer("114");
            $table->integer("115");
            $table->integer("116");
            $table->integer("117");
            $table->integer("118");
            $table->integer("119");
            $table->integer("1110");
            $table->integer("1111");
            $table->integer("1112");
            $table->integer("121");
            $table->integer("122");
            $table->integer("123");
            $table->integer("124");
            $table->integer("125");
            $table->integer("126");
            $table->integer("127");
            $table->integer("128");
            $table->integer("129");
            $table->integer("1210");
            $table->integer("1211");
            $table->integer("1212");
            $table->integer("131");
            $table->integer("132");
            $table->integer("133");
            $table->integer("134");
            $table->integer("135");
            $table->integer("136");
            $table->integer("137");
            $table->integer("138");
            $table->integer("139");
            $table->integer("1310");
            $table->integer("1311");
            $table->integer("1312");
            $table->integer("141");
            $table->integer("142");
            $table->integer("143");
            $table->integer("144");
            $table->integer("145");
            $table->integer("146");
            $table->integer("147");
            $table->integer("148");
            $table->integer("149");
            $table->integer("1410");
            $table->integer("1411");
            $table->integer("1412");
            $table->integer("151");
            $table->integer("152");
            $table->integer("153");
            $table->integer("154");
            $table->integer("155");
            $table->integer("156");
            $table->integer("157");
            $table->integer("158");
            $table->integer("159");
            $table->integer("1510");
            $table->integer("1511");
            $table->integer("1512");
            $table->integer("161");
            $table->integer("162");
            $table->integer("163");
            $table->integer("164");
            $table->integer("165");
            $table->integer("166");
            $table->integer("167");
            $table->integer("168");
            $table->integer("169");
            $table->integer("1610");
            $table->integer("1611");
            $table->integer("1612");
            $table->integer("171");
            $table->integer("172");
            $table->integer("173");
            $table->integer("174");
            $table->integer("175");
            $table->integer("176");
            $table->integer("177");
            $table->integer("178");
            $table->integer("179");
            $table->integer("1710");
            $table->integer("1711");
            $table->integer("1712");
            $table->integer("181");
            $table->integer("182");
            $table->integer("183");
            $table->integer("184");
            $table->integer("185");
            $table->integer("186");
            $table->integer("187");
            $table->integer("188");
            $table->integer("189");
            $table->integer("1810");
            $table->integer("1811");
            $table->integer("1812");
            $table->integer("191");
            $table->integer("192");
            $table->integer("193");
            $table->integer("194");
            $table->integer("195");
            $table->integer("196");
            $table->integer("197");
            $table->integer("198");
            $table->integer("199");
            $table->integer("1910");
            $table->integer("1911");
            $table->integer("1912");
            $table->integer("201");
            $table->integer("202");
            $table->integer("203");
            $table->integer("204");
            $table->integer("205");
            $table->integer("206");
            $table->integer("207");
            $table->integer("208");
            $table->integer("209");
            $table->integer("2010");
            $table->integer("2011");
            $table->integer("2012");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
};
