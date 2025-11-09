<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery', function (Blueprint $table) {
            $table->string('fld_trade_year2')->after('fld_trade_options')->nullable();
            $table->string('fld_trade_make2')->after('fld_trade_year2')->nullable();
            $table->string('fld_trade_model2')->after('fld_trade_make2')->nullable();
            $table->string('fld_trade_colour2')->after('fld_trade_model2')->nullable();
            $table->string('fld_trade_mileage2')->after('fld_trade_colour2')->nullable();
            $table->string('fld_trade_vin2')->after('fld_trade_mileage2')->nullable();
            $table->string('fld_trade_stock2')->after('fld_trade_vin2')->nullable();
            $table->string('fld_trade_acv2')->after('fld_trade_stock2')->nullable();
            $table->string('fld_trade_cylinder2')->after('fld_trade_acv2')->nullable();
            $table->string('fld_trade_transmission2')->after('fld_trade_cylinder2')->nullable();
            $table->string('fld_trade_type2')->after('fld_trade_transmission2')->nullable();
            $table->string('fld_trade_interior2')->after('fld_trade_type2')->nullable();
            $table->string('fld_trade_exterior2')->after('fld_trade_interior2')->nullable();
            $table->string('fld_trade_options2')->after('fld_trade_exterior2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery', function (Blueprint $table) {
            $table->dropColumn('fld_trade_year2');
            $table->dropColumn('fld_trade_make2');
            $table->dropColumn('fld_trade_model2');
            $table->dropColumn('fld_trade_colour2');
            $table->dropColumn('fld_trade_mileage2');
            $table->dropColumn('fld_trade_vin2');
            $table->dropColumn('fld_trade_stock2');
            $table->dropColumn('fld_trade_acv2');
            $table->dropColumn('fld_trade_cylinder2');
            $table->dropColumn('fld_trade_transmission2');
            $table->dropColumn('fld_trade_type2');
            $table->dropColumn('fld_trade_interior2');
            $table->dropColumn('fld_trade_exterior2');
            $table->dropColumn('fld_trade_options2');
        });
    }
}
