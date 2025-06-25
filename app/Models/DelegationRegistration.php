<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelegationRegistration extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Kolom-kolom yang sudah ada
        'registering_as',
        'delegate_type',
        'institution_name',
        'delegate_count',
        'full_name',
        'email',
        'phone',
        'nationality',
        'do_you_need_accommodation',
        'motivation_statement',
        'payment_proof_path',
        'social_media_proof_path',
        'referral_code',

        // --- TAMBAHKAN SEMUA KOLOM BARU DI SINI ---
        'council_preference_1',
        'country_preference_1_1',
        'country_preference_1_2',
        'reason_for_first_country_preference_1',
        'reason_for_second_country_preference_1',

        'council_preference_2',
        'country_preference_2_1',
        'country_preference_2_2',
        'reason_for_first_country_preference_2',
        'reason_for_second_country_preference_2',

        'council_preference_3',
        'country_preference_3_1',
        'country_preference_3_2',
        'reason_for_first_country_preference_3',
        'reason_for_second_country_preference_3',
        'is_verified',
    ];

    /**
     * Mendefinisikan relasi one-to-many ke model Delegate.
     */
    public function delegates()
    {
        return $this->hasMany(Delegate::class);
    }
}
