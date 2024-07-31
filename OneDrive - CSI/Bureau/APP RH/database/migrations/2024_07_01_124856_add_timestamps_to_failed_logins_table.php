<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToFailedLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('failed_logins', function (Blueprint $table) {
            if (!Schema::hasColumn('failed_logins', 'created_at') && !Schema::hasColumn('failed_logins', 'updated_at')) {
                $table->timestamps(); // This adds created_at and updated_at columns
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('failed_logins', function (Blueprint $table) {
            if (Schema::hasColumn('failed_logins', 'created_at') && Schema::hasColumn('failed_logins', 'updated_at')) {
                $table->dropTimestamps(); // This removes created_at and updated_at columns
            }
        });
    }
}
