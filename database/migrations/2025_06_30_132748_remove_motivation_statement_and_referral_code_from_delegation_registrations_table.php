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
            // Periksa apakah kolom ada sebelum menghapusnya
            if (Schema::hasColumn('delegation_registrations', 'motivation_statement')) {
                $table->dropColumn('motivation_statement');
            }
            if (Schema::hasColumn('delegation_registrations', 'referral_code')) {
                $table->dropColumn('referral_code');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Untuk jaga-jaga jika perlu rollback, kita buat kembali kolomnya
            $table->text('motivation_statement')->nullable();
            $table->string('referral_code')->nullable();
        });
    }
};
