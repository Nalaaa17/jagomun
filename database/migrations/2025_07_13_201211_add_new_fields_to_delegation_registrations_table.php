<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Menambahkan kolom untuk pengalaman MUN setelah 'package_type'
            $table->text('previous_mun_experience')->nullable()->after('package_type');
            $table->text('mun_awards')->nullable()->after('previous_mun_experience');

            // Mengubah nama kolom alasan agar sesuai dengan PDF
            $table->renameColumn('reason_for_first_country_preference_1', 'reason_for_council_preference_1');
            $table->renameColumn('reason_for_second_country_preference_1', 'reason_for_council_preference_2');

            // Anda memiliki 4 kolom reason di form, namun di PDF hanya 2 (1 per council).
            // Kolom ini bisa dihapus jika tidak digunakan, atau biarkan jika ada logika lain.
            // Untuk saat ini, kita akan rename saja.
            $table->renameColumn('reason_for_first_country_preference_2', 'reason_for_country_preference_2_1'); // Sesuaikan jika perlu
            $table->renameColumn('reason_for_second_country_preference_2', 'reason_for_country_preference_2_2'); // Sesuaikan jika perlu


            // Menambahkan kolom untuk path file dokumen
            $table->string('student_id_path')->nullable()->after('social_media_proof_path');
            $table->string('parental_consent_path')->nullable()->after('student_id_path');
            $table->string('partnership_code')->nullable()->after('parental_consent_path');

            // Menambahkan kolom untuk konfirmasi
            $table->boolean('info_confirmation')->default(false)->after('partnership_code');
            $table->boolean('data_usage_agreement')->default(false)->after('info_confirmation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Logika untuk rollback jika diperlukan
            $table->dropColumn(['date_of_birth', 'age', 'gender', 'full_address', 'previous_mun_experience', 'mun_awards', 'student_id_path', 'parental_consent_path', 'partnership_code', 'info_confirmation', 'data_usage_agreement']);
            $table->renameColumn('domicile_or_nationality', 'nationality');
            $table->renameColumn('reason_for_council_preference_1', 'reason_for_first_country_preference_1');
            $table->renameColumn('reason_for_council_preference_2', 'reason_for_second_country_preference_1');
            $table->renameColumn('reason_for_country_preference_2_1', 'reason_for_first_country_preference_2');
            $table->renameColumn('reason_for_country_preference_2_2', 'reason_for_second_country_preference_2');
        });
    }
};
