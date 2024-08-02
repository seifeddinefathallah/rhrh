<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_naissance');
            $table->string('email_professionnel')->unique();
            $table->string('email_personnel')->nullable();
            $table->string('matricule');
            $table->string('telephone');
            $table->string('code_postal');
            $table->string('ville');
            $table->string('pays');
            $table->string('adresse');
            $table->string('situation_familiale');
            $table->integer('nombre_enfants');
            $table->foreignId('entite_id')->constrained()->onDelete('cascade');
            $table->foreignId('departement_id')->constrained()->onDelete('cascade');
            $table->foreignId('poste_id')->constrained()->onDelete('cascade');
            $table->foreignId('contract_type_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('cin_numero')->nullable();
            $table->date('cin_date_delivrance')->nullable();
            $table->string('state')->nullable();


            // Residence Card
            $table->string('carte_sejour_numero')->nullable();
            $table->date('carte_sejour_date_delivrance')->nullable();
            $table->date('carte_sejour_date_expiration')->nullable();
            $table->string('carte_sejour_type')->nullable();

            // Passport (TN)
            $table->string('passeport_numero')->nullable();
            $table->date('passeport_date_delivrance')->nullable();
            $table->date('passeport_date_expiration')->nullable();
            $table->foreignId('contract_type_id')->nullable()->constrained('contract_types')->onDelete('cascade');
            $table->string('duree_contrat')->nullable(); // Durée du contrat (Maximum 18 mois, Variable, etc.)
            $table->date('debut_contrat')->nullable();
            $table->date('fin_contrat')->nullable();
            
            
            $table->string('passeport_delai_validite')->nullable();
            $table->string('duree_contrat')->nullable(); // Durée du contrat (Maximum 18 mois, Variable, etc.)
            $table->date('debut_contrat')->nullable();
            $table->date('fin_contrat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('state');
        });
        Schema::table('employees', function (Blueprint $table) {
            // Reverse the operations performed in the "up" method
            $table->dropColumn([

                'cin_number', 'cin_delivery_date',
                'residence_card_number', 'residence_card_delivery_date', 'residence_card_expiry_date', 'residence_card_type',
                'passport_number', 'passport_delivery_date', 'passport_expiry_date',
            ]);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['contract_type_id']);
            $table->dropColumn('contract_type_id');
        });
    }
}

