<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SecurityEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserApplicationController extends Controller
{
    public function index(User $user)
    {
        $applications = DB::table('applications')
            ->orderBy('id')
            ->get();

        $assignedApplications = DB::table('user_applications')
            ->where('user_id', $user->id)
            ->pluck('application_id')
            ->toArray();

        return view('admin.user-applications', compact(
            'user',
            'applications',
            'assignedApplications'
        ));
    }

    public function update(Request $request, User $user)
    {
        // Get selected applications from the Users page.
        $applicationIds = $request->input('application_ids', []);

        // Get the applications currently assigned to this user.
        $oldApplicationIds = DB::table('user_applications')
            ->where('user_id', $user->id)
            ->pluck('application_id')
            ->map(fn ($id) => (int) $id)
            ->toArray();

        // Convert submitted IDs to integers.
        $newApplicationIds = collect($applicationIds)
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Find access changes
        |--------------------------------------------------------------------------
        */

        $granted = array_diff(
            $newApplicationIds,
            $oldApplicationIds
        );

        $revoked = array_diff(
            $oldApplicationIds,
            $newApplicationIds
        );

        /*
        |--------------------------------------------------------------------------
        | Update application assignments
        |--------------------------------------------------------------------------
        */

        DB::table('user_applications')
            ->where('user_id', $user->id)
            ->delete();

        foreach ($newApplicationIds as $applicationId) {

            DB::table('user_applications')->insert([
                'user_id' => $user->id,
                'application_id' => $applicationId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Admin audit logging
        |--------------------------------------------------------------------------
        */

        $adminId = session('local_user_id');

        /*
        |--------------------------------------------------------------------------
        | Log newly granted applications
        |--------------------------------------------------------------------------
        */

        foreach ($granted as $applicationId) {

            $application = DB::table('applications')
                ->where('id', $applicationId)
                ->first();

            if ($application) {

                SecurityEvent::create([
                    'user_id' => $adminId,
                    'event_type' => 'APP_ACCESS_GRANTED',
                    'description' =>
                        'Application "' . $application->name .
                        '" access granted to user "' .
                        $user->email . '".',
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'risk_level' => 'low',
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Log revoked applications
        |--------------------------------------------------------------------------
        */

        foreach ($revoked as $applicationId) {

            $application = DB::table('applications')
                ->where('id', $applicationId)
                ->first();

            if ($application) {

                SecurityEvent::create([
                    'user_id' => $adminId,
                    'event_type' => 'APP_ACCESS_REVOKED',
                    'description' =>
                        'Application "' . $application->name .
                        '" access revoked from user "' .
                        $user->email . '".',
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'risk_level' => 'low',
                ]);
            }
        }

        return redirect('/users')
            ->with(
                'success',
                'Application access updated successfully.'
            );
    }
}
