<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthorizationBalancesToEmployees extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->decimal('sortie_balance', 8, 2)->default(2.00)->after('image'); // 2 hours
            $table->unsignedInteger('teletravail_days_balance')->default(5)->after('sortie_balance'); // 5 days
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['sortie_balance', 'teletravail_days_balance']);
        });
    }
}
