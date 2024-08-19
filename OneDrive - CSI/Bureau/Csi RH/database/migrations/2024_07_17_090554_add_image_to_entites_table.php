<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToEntitesTable extends Migration
{
    public function up()
    {
        Schema::table('entites', function (Blueprint $table) {
            $table->string('image')->nullable()->after('identifiant_etablissement');
        });
    }

    public function down()
    {
        Schema::table('entites', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
