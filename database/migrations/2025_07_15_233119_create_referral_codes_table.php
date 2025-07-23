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
    Schema::create('referral_codes', function (Blueprint $table) {
      $table->id();
      $table->string('code')->unique(); // Kode referralnya, harus unik
      $table->unsignedInteger('discount_amount'); // Jumlah potongan harganya
      $table->boolean('is_active')->default(true); // Untuk mengaktifkan/nonaktifkan kode
      $table->timestamp('expires_at')->nullable(); // Jika kode punya masa berlaku
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('referral_codes');
  }
};
