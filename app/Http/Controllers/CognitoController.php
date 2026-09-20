<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SecurityEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CognitoController extends Controller
{
    public function callback(Request $request)
    {
        // 1. Validate OAuth callback input
        $request->validate([
            'code' => ['nullable', 'string', 'max:4096'],
            'state' => ['nullable', 'string', 'max:4096'],
            'error' => ['nullable', 'string', 'max:255'],
            'error_description' => ['nullable', 'string', 'max:1000'],
        ]);

        // 2. Handle Cognito errors
        if ($request->has('error')) {
            return response()->json([
                'error' => $request->error,
                'description' => $request->error_description,
            ], 400);
        }

        // 3. Ensure authorization code exists
        if (!$request->has('code')) {
            return response()->json([
                'error' => 'Authorization code not received.'
            ], 400);
        }

        // 4. Validate OAuth state
        $savedState = session('cognito_state');

        if (
            !$savedState ||
            !hash_equals(
                $savedState,
                $request->state ?? ''
            )
        ) {
            abort(403, 'Invalid state parameter.');
        }

        // 5. Exchange authorization code for tokens
        $tokenResponse = Http::asForm()
            ->withBasicAuth(
                env('COGNITO_CLIENT_ID'),
                env('COGNITO_CLIENT_SECRET')
            )
            ->post(
                env('COGNITO_DOMAIN') . '/oauth2/token',
                [
                    'grant_type' => 'authorization_code',
                    'client_id' => env('COGNITO_CLIENT_ID'),
                    'code' => $request->code,
                    'redirect_uri' => env('COGNITO_REDIRECT_URI'),
                ]
            );

        // 6. Check token response
        if ($tokenResponse->failed()) {

            error_log(
                'COGNITO TOKEN EXCHANGE FAILED | HTTP ' .
                $tokenResponse->status() .
                ' | RESPONSE: ' .
                $tokenResponse->body()
            );

            return response()->json([
                'error' => 'Token exchange failed.',
                'status' => $tokenResponse->status(),
                'details' => $tokenResponse->json(),
            ], 400);
        }

        $tokens = $tokenResponse->json();

        // 7. Ensure access token exists
        if (empty($tokens['access_token'])) {
            return response()->json([
                'error' => 'Access token was not received.',
            ], 400);
        }

        // 8. Get Cognito user information
        $userResponse = Http::withToken(
            $tokens['access_token']
        )->get(
            env('COGNITO_DOMAIN') . '/oauth2/userInfo'
        );

        if ($userResponse->failed()) {
            return response()->json([
                'error' => 'Could not retrieve user information.',
                'status' => $userResponse->status(),
                'details' => $userResponse->json(),
            ], 400);
        }

        $cognitoUser = $userResponse->json();

        // 9. Get email
        $email = $cognitoUser['email'] ?? null;

        if (!$email) {
            return response()->json([
                'error' => 'Email was not provided by Cognito.'
            ], 400);
        }

        // 10. Get user's display name
        $name =
            $cognitoUser['name']
            ?? $cognitoUser['username']
            ?? 'Cognito User';

        // 11. Find local SecureCloud user
        $localUser = User::where(
            'email',
            $email
        )->first();

        // 12. Create local user if not found
        if (!$localUser) {

            $localUser = User::create([
                'name' => $name,
                'email' => $email,
                'role' => 'user',
                'password' => Str::random(60),
                'is_active' => true,
            ]);

        } else {

            // Update name from Cognito
            $localUser->update([
                'name' => $name,
            ]);
        }

        // 13. Blocked user check
        if (!$localUser->is_active) {

            SecurityEvent::create([
                'user_id' => $localUser->id,
                'event_type' => 'LOGIN_BLOCKED',
                'description' => 'Blocked user attempted to authenticate into SecureCloud.',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'risk_level' => 'high',
            ]);

            // Remove temporary OAuth state
            session()->forget('cognito_state');

            // Remove authenticated session data
            session()->forget([
                'cognito_access_token',
                'cognito_id_token',
                'cognito_user',
                'local_user_id',
                'local_user_role',
            ]);

            return redirect('/login')
                ->with(
                    'error',
                    'Your SecureCloud account has been blocked. Please contact an administrator.'
                );
        }

        // 14. Calculate authentication risk
        $recentLoginCount = SecurityEvent::where(
            'user_id',
            $localUser->id
        )
            ->where(
                'event_type',
                'login_success'
            )
            ->where(
                'created_at',
                '>=',
                now()->subMinutes(5)
            )
            ->count();

        if ($recentLoginCount >= 3) {

            $riskLevel = 'high';

            $description =
                'High-risk authentication activity detected: multiple login events within a short period.';

        } elseif ($recentLoginCount >= 1) {

            $riskLevel = 'medium';

            $description =
                'Repeated authentication activity detected within a short period.';

        } else {

            $riskLevel = 'low';

            $description =
                'Successful authentication through AWS Cognito.';
        }

        // 15. Regenerate session
        $request->session()->regenerate();

        // 16. Store authentication information
        session([
            'cognito_access_token' =>
                $tokens['access_token'],

            'cognito_id_token' =>
                $tokens['id_token'] ?? null,

            'cognito_user' =>
                $cognitoUser,

            'local_user_id' =>
                $localUser->id,

            'local_user_role' =>
                $localUser->role,
        ]);

        // 17. Record successful login
        SecurityEvent::create([
            'user_id' => $localUser->id,
            'event_type' => 'login_success',
            'description' => $description,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'risk_level' => $riskLevel,
        ]);

        // 18. Remove temporary OAuth state
        session()->forget('cognito_state');

        // 19. Redirect authenticated user
        return redirect('/dashboard');
    }
}
