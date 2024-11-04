<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('cash_advances', function (Blueprint $table) {
            $table->string('reference_number')->unique()->nullable()->after('id');
        });
    }

    public function down()
    {
        Schema::table('cash_advances', function (Blueprint $table) {
            $table->dropColumn('reference_number');
        });
    }
};