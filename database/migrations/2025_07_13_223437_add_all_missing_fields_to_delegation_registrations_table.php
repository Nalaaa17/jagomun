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
            // Menambahkan kolom personal info
            $table->date('date_of_birth')->nullable()->after('full_name');
            $table->integer('age')->nullable()->after('date_of_birth');
            $table->string('gender', 50)->nullable()->after('age');
            $table->text('full_address')->nullable()->after('institution_name');

            // Menambahkan kolom pengalaman
            $table->text('previous_mun_experience')->nullable()->after('package_type');
            $table->text('mun_awards')->nullable()->after('previous_mun_experience');

            // Menambahkan kolom path dokumen & kode
            $table->string('student_id_path')->nullable()->after('social_media_proof_path');
            $table->string('parental_consent_path')->nullable()->after('student_id_path');
            $table->string('partnership_code')->nullable()->after('parental_consent_path');

            // Menambahkan kolom konfirmasi
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
            // Menghapus semua kolom yang ditambahkan jika di-rollback
            $table->dropColumn([
                'date_of_birth',
                'age',
                'gender',
                'full_address',
                'previous_mun_experience',
                'mun_awards',
                'student_id_path',
                'parental_consent_path',
                'partnership_code',
                'info_confirmation',
                'data_usage_agreement'
            ]);
        });
    }
};
