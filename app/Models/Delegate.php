<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    protected $table = 'delegates'; // Nama tabel di database

    protected $fillable = [
        'delegation_registration_id',
        'delegate_number',
        'full_name',
        'email',
        'phone',
        'nationality',
        'package_type',
        'do_you_need_accommodation',
        'attendance_type',
        'social_media_upload',
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
    ];

    public function delegationRegistration()
    {
        return $this->belongsTo(DelegationRegistration::class);
    }
}
