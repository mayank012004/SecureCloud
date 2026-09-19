<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\CognitoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\SecurityApiController;
use App\Http\Controllers\Admin\UserApplicationController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [HelloController::class, 'hello']);


/*
|--------------------------------------------------------------------------
| Cognito Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('login');
});


/*
|--------------------------------------------------------------------------
| Switch Cognito Account
|--------------------------------------------------------------------------
*/

Route::get('/switch-account', function () {

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

    $logoutUrl = env('COGNITO_DOMAIN') . '/logout?' .
        http_build_query([
            'client_id' => env('COGNITO_CLIENT_ID'),
            'logout_uri' => env('COGNITO_LOGOUT_URI'),
        ]);

    return redirect($logoutUrl);
});


Route::get('/auth/cognito', function () {

    $state = bin2hex(random_bytes(16));

    session([
        'cognito_state' => $state
    ]);

    $query = http_build_query([
        'client_id' => env('COGNITO_CLIENT_ID'),
        'response_type' => 'code',
        'scope' => 'openid email profile',
        'redirect_uri' => env('COGNITO_REDIRECT_URI'),
        'state' => $state,
    ]);

    return redirect(
        env('COGNITO_DOMAIN') . '/oauth2/authorize?' . $query
    );

})->middleware('throttle:cognito-login');


Route::get('/callback', [
    CognitoController::class,
    'callback'
]);


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(\App\Http\Middleware\CognitoAuth::class);


Route::get('/profile', function () {
    return view('profile');
})->middleware(\App\Http\Middleware\CognitoAuth::class);


/*
|--------------------------------------------------------------------------
| Admin Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/admin', function () {
    return view('admin');
})->middleware('admin');


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::get('/logout', function () {

    $userId = session('local_user_id');

    if ($userId) {
        \App\Models\SecurityEvent::create([
            'user_id' => $userId,
            'event_type' => 'logout',
            'description' => 'User logged out of SecureCloud.',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'risk_level' => 'low',
        ]);
    }

    session()->forget([
        'cognito_access_token',
        'cognito_id_token',
        'cognito_user',
        'local_user_id',
        'local_user_role',
    ]);

    session()->invalidate();
    session()->regenerateToken();

    $logoutUrl = env('COGNITO_DOMAIN') . '/logout?' .
        http_build_query([
            'client_id' => env('COGNITO_CLIENT_ID'),
            'logout_uri' => env('COGNITO_LOGOUT_URI'),
        ]);

    return redirect($logoutUrl);
});


/*
|--------------------------------------------------------------------------
| Protected REST APIs
|--------------------------------------------------------------------------
*/

Route::middleware(\App\Http\Middleware\CognitoAuth::class)->group(function () {

    Route::get('/api/users', [
        SecurityApiController::class,
        'users'
    ]);

    Route::get('/api/security-events', [
        SecurityApiController::class,
        'events'
    ]);

    Route::get('/api/security-events/{id}', [
        SecurityApiController::class,
        'event'
    ]);
});


/*
|--------------------------------------------------------------------------
| Client Portal
|--------------------------------------------------------------------------
*/

Route::get('/client-portal', function () {

    if (!session()->has('cognito_user')) {
        return redirect('/login');
    }

    return redirect('http://127.0.0.1:9000');

});


/*
|--------------------------------------------------------------------------
| Admin Application Access Management
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/admin/applications', [
        \App\Http\Controllers\AdminApplicationController::class,
        'index'
    ])->name('admin.applications');


    Route::put('/admin/applications/{user}', [
        \App\Http\Controllers\AdminApplicationController::class,
        'update'
    ])->name('admin.applications.update');

});


/*
|--------------------------------------------------------------------------
| Applications
|--------------------------------------------------------------------------
*/

Route::middleware(\App\Http\Middleware\CognitoAuth::class)->group(function () {

    Route::get('/applications', [
        \App\Http\Controllers\ApplicationController::class,
        'index'
    ])->name('applications.index');


    Route::get('/applications/{application}/launch', [
        \App\Http\Controllers\ApplicationController::class,
        'launch'
    ])->name('applications.launch');

});


/*
|--------------------------------------------------------------------------
| Admin User Application Access
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/admin/user-applications/{user}', [
        UserApplicationController::class,
        'index'
    ])->name('admin.user-applications');


    Route::put('/admin/user-applications/{user}', [
        UserApplicationController::class,
        'update'
    ])->name('admin.user-applications.update');

});


/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {

    Route::get('/users', [
        UserController::class,
        'index'
    ])->name('users.index');


    Route::post('/users/{user}/block', [
        UserController::class,
        'block'
    ])->name('users.block');


    Route::post('/users/{user}/unblock', [
        UserController::class,
        'unblock'
    ])->name('users.unblock');

});
