<?php
// database/migrations/create_administrative_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativeRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('administrative_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('status')->default('En attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrative_requests');
    }
}

