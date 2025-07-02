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
    $table->string('attendance_type')->after('package_type')->nullable();
    $table->boolean('do_you_need_accommodation')->after('attendance_type')->default(false);
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
