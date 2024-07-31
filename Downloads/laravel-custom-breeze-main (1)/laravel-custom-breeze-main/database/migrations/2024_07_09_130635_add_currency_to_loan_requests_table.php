<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyToLoanRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->string('currency')->after('amount')->default('TND');
        });
    }

    public function down()
    {
        Schema::table('loan_requests', function (Blueprint $table) {
            $table->dropColumn('currency');
        });
    }
}

