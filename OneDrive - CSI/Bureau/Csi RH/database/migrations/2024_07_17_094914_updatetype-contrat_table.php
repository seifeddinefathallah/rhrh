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
        Schema::create('contract_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('country');
            $table->string('classification')->nullable();
            $table->integer('coefficient')->nullable();
            $table->integer('probation_period')->nullable();
            $table->boolean('renouvellement')->default(true); // Boolean field 
            $table->integer('cdt_renouv')->default(2); // Integer field with default value 2
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
