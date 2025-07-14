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
        // Kolom-kolom yang sudah ada (disesuaikan)
        'registering_as',
        'delegate_type',
        'institution_name',
        'delegate_count',
        'total_price',

        // Informasi Pribadi (Lama + Baru)
        'full_name',
        'date_of_birth',
        'age',
        'gender',
        'email',
        'phone',
        'nationality',
        'full_address',

        // Kehadiran & Paket
        'attendance_type',
        'package_type',
        'needs_accommodation', // Ganti dari 'do_you_need_accommodation'

        // Pengalaman MUN
        'previous_mun_experience',
        'mun_awards',

        // Preferensi Council (Disederhanakan menjadi 2 preferensi sesuai PDF)
        'council_preference_1',
        'country_preference_1_1',
        'country_preference_1_2',
        'reason_for_council_preference_1', // Ganti nama

        'council_preference_2',
        'country_preference_2_1',
        'country_preference_2_2',
        'reason_for_council_preference_2', // Ganti nama

        // Path File Upload
        'payment_proof_path',
        'social_media_proof_path',
        'student_id_path',
        'parental_consent_path',

        // Lainnya
        'partnership_code',

        // Konfirmasi
        'info_confirmation',
        'data_usage_agreement',

        // Status Verifikasi
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
