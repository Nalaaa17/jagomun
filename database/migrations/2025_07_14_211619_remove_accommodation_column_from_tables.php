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
        // Hapus kolom dari tabel delegation_registrations
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Cek jika kolom ada sebelum menghapusnya
            if (Schema::hasColumn('delegation_registrations', 'do_you_need_accommodation')) {
                $table->dropColumn('do_you_need_accommodation');
            }
            if (Schema::hasColumn('delegation_registrations', 'needs_accommodation')) {
                $table->dropColumn('needs_accommodation');
            }
        });

        // Hapus kolom dari tabel delegates
        Schema::table('delegates', function (Blueprint $table) {
            if (Schema::hasColumn('delegates', 'do_you_need_accommodation')) {
                $table->dropColumn('do_you_need_accommodation');
            }
             if (Schema::hasColumn('delegates', 'needs_accommodation')) {
                $table->dropColumn('needs_accommodation');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika di-rollback, buat kembali kolomnya
        Schema::table('delegation_registrations', function (Blueprint $table) {
            $table->boolean('needs_accommodation')->default(false)->after('total_price');
        });

        Schema::table('delegates', function (Blueprint $table) {
            $table->boolean('needs_accommodation')->default(false)->after('package_type');
        });
    }
};
