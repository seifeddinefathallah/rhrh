<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyRequestsTable extends Migration
{
public function up()
{
Schema::create('supply_requests', function (Blueprint $table) {
$table->id();
$table->unsignedBigInteger('employee_id'); // assuming each request is linked to an employee
$table->string('item_name');
$table->integer('quantity');
$table->string('status')->default('pending');
$table->timestamps();

$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
});
}

public function down()
{
Schema::dropIfExists('supply_requests');
}
}
