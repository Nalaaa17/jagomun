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
        // Menambahkan kolom 'package_type' ke tabel utama
        Schema::table('delegation_registrations', function (Blueprint $table) {
            $table->string('package_type')->nullable()->after('attendance_type');
        });

        // Menambahkan kolom yang sama ke tabel 'delegates' (untuk anggota delegasi)
        // Beri komentar jika Anda tidak memiliki tabel 'delegates' atau tidak memerlukannya.
        if (Schema::hasTable('delegates')) {
            Schema::table('delegates', function (Blueprint $table) {
                $table->string('package_type')->nullable()->after('nationality');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            $table->dropColumn('package_type');
        });

        if (Schema::hasTable('delegates')) {
            Schema::table('delegates', function (Blueprint $table) {
                $table->dropColumn('package_type');
            });
        }
    }
};
