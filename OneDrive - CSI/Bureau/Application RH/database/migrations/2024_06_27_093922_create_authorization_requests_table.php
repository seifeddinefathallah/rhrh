<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizationRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('authorization_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('duration_type');
            $table->string('duration')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authorization_requests');
    }
}
