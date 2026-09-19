<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SecurityEvent;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display all normal users.
     */
    public function index()
    {
        // Get all normal users. Admin accounts are excluded.
        $users = User::where('role', '!=', 'admin')
            ->orderBy('name')
            ->get();

        // Get all applications registered in SecureCloud.
        $applications = DB::table('applications')
            ->orderBy('id')
            ->get();

        // Get currently assigned applications for each user.
        $userApplications = DB::table('user_applications')
            ->get()
            ->groupBy('user_id');

        return view('admin.users', compact(
            'users',
            'applications',
            'userApplications'
        ));
    }

    /**
     * Block a user.
     */
    public function block(User $user)
    {
        // Never allow an admin account to be blocked.
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin accounts cannot be blocked.');
        }

        // Prevent blocking an already blocked user.
        if (!$user->is_active) {
            return back()->with('error', 'User is already blocked.');
        }

        $user->update([
            'is_active' => false,
        ]);

        // Record the action in the security audit log.
        SecurityEvent::create([
            'user_id' => $user->id,
            'event_type' => 'USER_BLOCKED',
            'description' => 'User account was blocked by an administrator.',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'risk_level' => 'medium',
        ]);

        return back()->with('success', 'User has been blocked successfully.');
    }

    /**
     * Unblock a user.
     */
    public function unblock(User $user)
    {
        // Never allow an admin account to be modified through this action.
        if ($user->role === 'admin') {
            return back()->with('error', 'Admin accounts cannot be modified here.');
        }

        // Prevent unnecessary unblock operation.
        if ($user->is_active) {
            return back()->with('error', 'User is already active.');
        }

        $user->update([
            'is_active' => true,
        ]);

        // Record the action in the security audit log.
        SecurityEvent::create([
            'user_id' => $user->id,
            'event_type' => 'USER_UNBLOCKED',
            'description' => 'User account was unblocked by an administrator.',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'risk_level' => 'low',
        ]);

        return back()->with('success', 'User has been unblocked successfully.');
    }
}
