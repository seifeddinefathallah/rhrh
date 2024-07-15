<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodDefinitionIdToTemporaryBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temporary_balances', function (Blueprint $table) {
            // Add the foreign key column
            $table->foreignId('period_definition_id')
                ->constrained('period_definitions') // Reference the period_definitions table
                ->onDelete('cascade') // Set up cascading deletes
                ->after('end_date'); // Place the column after 'end_date'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temporary_balances', function (Blueprint $table) {
            // Drop the foreign key constraint and column
            $table->dropForeign(['period_definition_id']);
            $table->dropColumn('period_definition_id');
        });
    }
}

