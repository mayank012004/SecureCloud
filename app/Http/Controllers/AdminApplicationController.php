<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Application;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    /**
     * Show application access management page.
     */
    public function index()
    {
        $users = User::orderBy('name')->get();

        $applications = Application::where('status', 'active')
            ->orderBy('name')
            ->get();

        return view('admin.applications', compact(
            'users',
            'applications'
        ));
    }

    /**
     * Update which applications a user can access.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'applications' => ['nullable', 'array'],
            'applications.*' => ['integer', 'exists:applications,id'],
        ]);

        $applicationIds = $request->input(
            'applications',
            []
        );

        $user->applications()->sync($applicationIds);

        return redirect()
            ->route('admin.applications')
            ->with(
                'success',
                'Application access updated successfully.'
            );
    }
}
