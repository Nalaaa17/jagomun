<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'delegates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'delegation_registration_id',
        'delegate_number',

        // Personal Info (Lama + Baru)
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'age',
        'gender',
        'nationality',
        'full_address',

        // Package & Attendance
        'package_type',
        'needs_accommodation', // Menggantikan do_you_need_accommodation
        'attendance_type',

        // Experience
        'previous_mun_experience',
        'mun_awards',

        // Council Preferences (Disederhanakan & Diperbaiki)
        'council_preference_1',
        'country_preference_1_1',
        'country_preference_1_2',
        'reason_for_council_preference_1', // Menggantikan reason_for_first_country_preference_1
        'council_preference_2',
        'country_preference_2_1',
        'country_preference_2_2',
        'reason_for_council_preference_2', // Menggantikan reason_for_second_country_preference_1

        // Document Paths & Code
        'student_id_path',
        'parental_consent_path',
        'social_media_proof_path', // Menggantikan social_media_upload
        'partnership_code',

        // Confirmations
        'info_confirmation',
        'data_usage_agreement',
    ];

    /**
     * Get the delegation registration that owns the delegate.
     */
    public function delegationRegistration()
    {
        return $this->belongsTo(DelegationRegistration::class);
    }
}
