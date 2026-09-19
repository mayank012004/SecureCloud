<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Applications
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        // Admins can see all active applications
        if (session('local_user_role') === 'admin') {

            $applications = Application::where('status', 'active')
                ->orderBy('name')
                ->get();

            return view('applications.index', compact('applications'));
        }

        // Normal users can only see applications assigned to them
        $userId = session('local_user_id');

        $applications = Application::where('status', 'active')
            ->whereHas('users', function ($query) use ($userId) {
                $query->where('users.id', $userId);
            })
            ->orderBy('name')
            ->get();

        return view('applications.index', compact('applications'));
    }


    /*
    |--------------------------------------------------------------------------
    | Launch Application
    |--------------------------------------------------------------------------
    */

    public function launch(Application $application)
    {
        // Application must be active
        if ($application->status !== 'active') {
            abort(404);
        }

        // Admins can launch any active application
        if (session('local_user_role') === 'admin') {
            return redirect()->away($application->url);
        }

        // Normal users must have explicit access
        $userId = session('local_user_id');

        $hasAccess = $application->users()
            ->where('users.id', $userId)
            ->exists();

        if (!$hasAccess) {
            abort(403, 'You do not have access to this application.');
        }

        return redirect()->away($application->url);
    }
}
