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
            ]);
        });
    }
};
