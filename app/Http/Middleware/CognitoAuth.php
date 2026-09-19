<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\SecurityEvent;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CognitoAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Check authentication session
        |--------------------------------------------------------------------------
        */

        if (!session()->has('cognito_user')) {

            return redirect('/login');
        }


        /*
        |--------------------------------------------------------------------------
        | 2. Get local SecureCloud user
        |--------------------------------------------------------------------------
        */

        $localUserId = session('local_user_id');

        if (!$localUserId) {

            session()->invalidate();
            session()->regenerateToken();

            return redirect('/login');
        }


        $localUser = User::find($localUserId);


        /*
        |--------------------------------------------------------------------------
        | 3. Verify local user still exists
        |--------------------------------------------------------------------------
        */

        if (!$localUser) {

            session()->invalidate();
            session()->regenerateToken();

            return redirect('/login')
                ->with(
                    'error',
                    'Your SecureCloud account could not be found.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | 4. Check whether account is blocked
        |--------------------------------------------------------------------------
        */

        if (!$localUser->is_active) {

            /*
            |--------------------------------------------------------------------------
            | Record blocked active-session event
            |--------------------------------------------------------------------------
            */

            SecurityEvent::create([
                'user_id' => $localUser->id,
                'event_type' => 'SESSION_BLOCKED',
                'description' => 'Active SecureCloud session terminated because the user account was blocked by an administrator.',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'risk_level' => 'high',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Clear authentication session
            |--------------------------------------------------------------------------
            */

            session()->forget([
                'cognito_access_token',
                'cognito_id_token',
                'cognito_user',
                'local_user_id',
                'local_user_role',
                'cognito_state',
            ]);

            session()->invalidate();
            session()->regenerateToken();


            /*
            |--------------------------------------------------------------------------
            | Redirect blocked user to login
            |--------------------------------------------------------------------------
            */

            return redirect('/login')
                ->with(
                    'error',
                    'Your SecureCloud account has been blocked. Please contact an administrator.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | 5. User is authenticated and active
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}

