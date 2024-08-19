<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_certificate_upload_deadline_to_leave_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertificateUploadDeadlineToLeaveRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            // Ajoutez la colonne pour la date limite de téléchargement du certificat médical
            $table->timestamp('certificate_upload_deadline')->nullable()->after('medical_certificate');
        });
    }

    public function down()
    {
        Schema::table('leave_requests', function (Blueprint $table) {
            // Supprimez la colonne lors du rollback
            $table->dropColumn('certificate_upload_deadline');
        });
    }
}

