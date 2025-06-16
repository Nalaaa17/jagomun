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
        Schema::create('delegation_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registering_as'); // e.g., 'Individual Delegate', 'Delegation', 'Observer'
            $table->string('delegate_type')->nullable(); // e.g., 'National Delegate', 'International Delegate'

            // Fields that apply to the overall registration (for Delegation & Observer)
            $table->string('institution_name')->nullable();
            $table->boolean('do_you_need_accommodation')->nullable(); // For observer/delegation if asked

            // For Individual Delegate, these will be here too but direct
            $table->string('full_name')->nullable(); // For Individual Delegate
            $table->string('email')->nullable();     // For Individual Delegate
            $table->string('phone')->nullable();     // For Individual Delegate
            $table->string('nationality')->nullable(); // For Individual Delegate
            $table->text('motivation_statement')->nullable(); // For Individual Delegate

            // Payment & Social Media Proof (for all types)
            $table->string('payment_proof_path')->nullable();
            $table->string('social_media_proof_path')->nullable();
            $table->string('referral_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegation_registrations');
    }
};
