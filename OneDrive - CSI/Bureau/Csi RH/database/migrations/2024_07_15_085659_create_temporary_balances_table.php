<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporaryBalancesTable extends Migration
{
    /**
     * Exécutez la migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporary_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('sortie_hours', 5, 2)->default(0);
            $table->decimal('teletravail_days', 5, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Révélez la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporary_balances');
    }
}

