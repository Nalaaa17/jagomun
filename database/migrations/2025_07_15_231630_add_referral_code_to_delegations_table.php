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
    Schema::table('delegates', function (Blueprint $table) {
        // Tambahkan baris ini
        $table->string('referral_code')->nullable()->after('partnership_code'); // 'after' opsional
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delegates', function (Blueprint $table) {
            //
        });
    }
};
