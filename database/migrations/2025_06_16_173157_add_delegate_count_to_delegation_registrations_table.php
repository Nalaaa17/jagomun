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
            // Tambahkan baris ini.
            // Anda bisa meletakkannya setelah kolom 'institution_name' agar urutannya logis.
            $table->integer('delegate_count')->nullable()->after('institution_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Ini untuk membatalkan migrasi jika diperlukan
            $table->dropColumn('delegate_count');
        });
    }
};
