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
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            // Foreign key to link to the main registration
            $table->foreignId('delegation_registration_id')->constrained('delegation_registrations')->onDelete('cascade');
            $table->integer('delegate_number'); // e.g., Delegate 1, Delegate 2

            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('nationality');
            $table->string('mun_experience')->nullable(); // Example: MUN Experience (Format: MUN@_Board_Council)
            $table->string('social_media_upload')->nullable(); // Path to uploaded file

            // Council Preference 1
            $table->string('council_preference_1')->nullable();
            $table->string('country_preference_1_1')->nullable();
            $table->string('country_preference_1_2')->nullable();
            $table->text('reason_for_first_country_preference_1')->nullable();
            $table->text('reason_for_second_country_preference_1')->nullable();

            // Council Preference 2
            $table->string('council_preference_2')->nullable();
            $table->string('country_preference_2_1')->nullable();
            $table->string('country_preference_2_2')->nullable();
            $table->text('reason_for_first_country_preference_2')->nullable();
            $table->text('reason_for_second_country_preference_2')->nullable();

            // Council Preference 3
            $table->string('council_preference_3')->nullable();
            $table->string('country_preference_3_1')->nullable();
            $table->string('country_preference_3_2')->nullable();
            $table->text('reason_for_first_country_preference_3')->nullable();
            $table->text('reason_for_second_country_preference_3')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegates');
    }
};
