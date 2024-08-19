<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntitesTable extends Migration
{
    public function up()
    {
        Schema::create('entites', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('numero_fiscal');
            $table->string('adresse');
            $table->string('pays');
            $table->string('contact');
            $table->string('numero_siret');
            $table->string('code_ape_naf');
            $table->string('convention_collective');
            $table->string('identifiant_etablissement');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entites');
    }
}
