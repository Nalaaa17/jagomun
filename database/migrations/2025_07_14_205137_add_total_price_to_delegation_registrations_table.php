<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            // Menambahkan kolom untuk harga setelah package_type
            // decimal lebih baik untuk menyimpan nilai mata uang
            $table->decimal('total_price', 15, 2)->default(0)->after('package_type');
        });
    }

    public function down(): void
    {
        Schema::table('delegation_registrations', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });
    }
};
