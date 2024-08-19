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
            $table->string('numero_siret')->nullable(); // Nullable since it's only required for France
            $table->string('code_ape_naf')->nullable(); // Nullable since it's only required for France
            $table->string('convention_collective')->nullable();
            $table->string('identifiant_etablissement')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entites');
    }
}
