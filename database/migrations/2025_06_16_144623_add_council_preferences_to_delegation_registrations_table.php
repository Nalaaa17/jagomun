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
            // Menambahkan kolom untuk menyimpan pilihan council dan alasan
            // Ini akan digunakan terutama oleh 'Individual Delegate' dan 'Observer'

            // --- Council Preference 1 ---
            $table->string('council_preference_1')->nullable()->after('referral_code');
            $table->string('country_preference_1_1')->nullable()->after('council_preference_1');
            $table->string('country_preference_1_2')->nullable()->after('country_preference_1_1');
            $table->text('reason_for_first_country_preference_1')->nullable()->after('country_preference_1_2');
            $table->text('reason_for_second_country_preference_1')->nullable()->after('reason_for_first_country_preference_1');

            // --- Council Preference 2 ---
            $table->string('council_preference_2')->nullable()->after('reason_for_second_country_preference_1');
            $table->string('country_preference_2_1')->nullable()->after('council_preference_2');
            $table->string('country_preference_2_2')->nullable()->after('country_preference_2_1');
            $table->text('reason_for_first_country_preference_2')->nullable()->after('country_preference_2_2');
            $table->text('reason_for_second_country_preference_2')->nullable()->after('reason_for_first_country_preference_2');

            // --- Council Preference 3 ---
            $table->string('council_preference_3')->nullable()->after('reason_for_second_country_preference_2');
            $table->string('country_preference_3_1')->nullable()->after('council_preference_3');
            $table->string('country_preference_3_2')->nullable()->after('country_preference_3_1');
            $table->text('reason_for_first_country_preference_3')->nullable()->after('country_preference_3_2');
            $table->text('reason_for_second_country_preference_3')->nullable()->after('reason_for_first_country_preference_3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Daftar kolom yang akan dihapus jika migrasi di-rollback
            $columns_to_drop = [
                'council_preference_1', 'country_preference_1_1', 'country_preference_1_2',
                'reason_for_first_country_preference_1', 'reason_for_second_country_preference_1',
                'council_preference_2', 'country_preference_2_1', 'country_preference_2_2',
                'reason_for_first_country_preference_2', 'reason_for_second_country_preference_2',
                'council_preference_3', 'country_preference_3_1', 'country_preference_3_2',
                'reason_for_first_country_preference_3', 'reason_for_second_country_preference_3'
            ];
            $table->dropColumn($columns_to_drop);
        });
    }
};
