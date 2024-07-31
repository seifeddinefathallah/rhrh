<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultBalancesTable extends Migration
{
    /**
     * Exécutez la migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('period'); // 'day', 'month', 'year'
            $table->decimal('sortie_balance', 8, 2)->default(2.00); // Valeur par défaut pour les sorties
            $table->decimal('teletravail_days_balance', 8, 2)->default(5.00); // Valeur par défaut pour le télétravail
            $table->timestamps();

            // Clé étrangère pour lier à la table employees
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Révélez la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('default_balances');
    }
}
