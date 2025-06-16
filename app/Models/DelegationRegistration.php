<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelegationRegistration extends Model
{
    use HasFactory;

    protected $table = 'delegation_registrations';

    protected $fillable = [
        'registering_as',
        'delegate_type', // Can be null for Observer
        'full_name',
        'email',
        'phone',
        'nationality',
        'institution_name',
        'motivation_statement', // Might be optional for Observer
        'do_you_need_accommodation', // Can be null/false for Observer
        'payment_proof_path',
        'social_media_proof_path',
        'referral_code',
    ];

    protected $casts = [
        'do_you_need_accommodation' => 'boolean',
    ];

    public function delegates()
    {
        return $this->hasMany(Delegate::class);
    }
}
