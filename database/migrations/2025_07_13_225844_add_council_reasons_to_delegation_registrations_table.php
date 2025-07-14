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
            // Menambahkan kolom alasan setelah kolom preferensi negara
            // Ini adalah lokasi yang logis dan sesuai dengan urutan di form Anda
            $table->text('reason_for_council_preference_1')->nullable()->after('country_preference_1_2');
            $table->text('reason_for_council_preference_2')->nullable()->after('country_preference_2_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Ini akan dijalankan jika Anda melakukan rollback
            $table->dropColumn(['reason_for_council_preference_1', 'reason_for_council_preference_2']);
        });
    }
};
