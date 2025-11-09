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
            $table->string('trade_manager_acv')->after('fld_trade_options2')->nullable();
            $table->string('trade_manager_acv2')->after('trade_manager_acv')->nullable();
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
            $table->dropColumn('trade_manager_acv');
            $table->dropColumn('trade_manager_acv2');
        });
    }
}
