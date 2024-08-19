<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStartTimeToAuthorizationRequestsTable extends Migration
{
/**
* Run the migrations.
*
* @return void
*/
public function up()
{
Schema::table('authorization_requests', function (Blueprint $table) {
$table->time('start_time')->after('start_date');
});
}

/**
* Reverse the migrations.
*
* @return void
*/
public function down()
{
Schema::table('authorization_requests', function (Blueprint $table) {
$table->dropColumn('start_time');
});
}
}
