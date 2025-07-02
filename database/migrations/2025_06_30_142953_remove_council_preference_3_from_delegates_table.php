<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('delegates', function (Blueprint $table) {
            // Perintah ini akan menghapus semua kolom yang terkait dengan preferensi 3
            $table->dropColumn([
                'council_preference_3',
                'country_preference_3_1',
                'country_preference_3_2',
                'reason_for_first_country_preference_3',
                'reason_for_second_country_preference_3',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('delegates', function (Blueprint $table) {
            $table->string('council_preference_3')->nullable();
            $table->string('country_preference_3_1')->nullable();
            $table->string('country_preference_3_2')->nullable();
            $table->text('reason_for_first_country_preference_3')->nullable();
            $table->text('reason_for_second_country_preference_3')->nullable();
        });
    }
};
