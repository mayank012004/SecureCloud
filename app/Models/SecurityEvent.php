<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityEvent extends Model
{
    protected $fillable = [
        'user_id',
        'event_type',
        'description',
        'ip_address',
        'user_agent',
        'risk_level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSecurityAnalysisAttribute()
    {
        return match ($this->event_type) {

            'APP_ACCESS_GRANTED' => [
                'summary' =>
                    'Application access was granted by an administrator.',
                'recommendation' =>
                    'Verify that the assigned application matches the user\'s role and responsibilities.',
            ],

            'APP_ACCESS_REVOKED' => [
                'summary' =>
                    'Application access was revoked by an administrator.',
                'recommendation' =>
                    'Confirm that the revocation was intentional and review any dependent workflows if necessary.',
            ],

            'login_success' => [
                'summary' =>
                    'A successful authentication event was recorded through AWS Cognito.',
                'recommendation' =>
                    'No immediate security action is required.',
            ],

            'logout' => [
                'summary' =>
                    'The user ended their SecureCloud session.',
                'recommendation' =>
                    'No immediate security action is required.',
            ],

            default => match ($this->risk_level) {

                'high' => [
                    'summary' =>
                        'Multiple authentication events were detected within a short period.',
                    'recommendation' =>
                        'Monitor the account and consider additional verification.',
                ],

                'medium' => [
                    'summary' =>
                        'Repeated authentication activity was detected.',
                    'recommendation' =>
                        'Continue monitoring the account for unusual activity.',
                ],

                default => [
                    'summary' =>
                        'The recorded security activity appears normal.',
                    'recommendation' =>
                        'No immediate security action is required.',
                ],
            },
        };
    }
}
