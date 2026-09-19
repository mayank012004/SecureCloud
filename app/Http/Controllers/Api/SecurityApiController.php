<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SecurityEvent;
use Illuminate\Http\JsonResponse;

class SecurityApiController extends Controller
{
    // Get all users
    public function users(): JsonResponse
    {
        $users = User::select(
            'id',
            'name',
            'email',
            'role',
            'created_at'
        )->get();

        return response()->json([
            'success' => true,
            'count' => $users->count(),
            'users' => $users,
        ]);
    }

    // Get recent security events
    public function events(): JsonResponse
    {
        $events = SecurityEvent::with('user')
            ->latest()
            ->take(20)
            ->get();

        return response()->json([
            'success' => true,
            'count' => $events->count(),
            'events' => $events,
        ]);
    }

    // Get one security event
    public function event(int $id): JsonResponse
    {
        $event = SecurityEvent::with('user')->find($id);

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Security event not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'event' => $event,
        ]);
    }
}
