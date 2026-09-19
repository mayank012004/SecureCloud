@php
    $cognitoUser = session('cognito_user', []);

    $name = $cognitoUser['name']
        ?? $cognitoUser['preferred_username']
        ?? 'Cognito User';

    $email = $cognitoUser['email'] ?? 'N/A';
    $username = $cognitoUser['username'] ?? 'N/A';
    $sub = $cognitoUser['sub'] ?? 'N/A';

    $role = session('local_user_role', 'user');
    $localUserId = session('local_user_id', 'N/A');

    $verified = $cognitoUser['email_verified'] ?? false;

    $avatarLetter = strtoupper(substr($name, 0, 1));
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SecureCloud Profile</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #05080f;
            color: #e8edf5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 45px 30px;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7185a0;
            margin-bottom: 38px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 28px;
            border: 1px solid #23344a;
            border-radius: 18px;
            background: #080d16;
            margin-bottom: 22px;
        }

        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            color: white;
            background: linear-gradient(135deg, #00d9ff, #1261a0);
            box-shadow: 0 0 25px rgba(0, 217, 255, 0.25);
        }

        .name {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .email {
            color: #91a4bd;
        }

        .verified {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            border: 1px solid #00d084;
            border-radius: 20px;
            color: #00e28a;
            font-size: 12px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .card {
            background: #080d16;
            border: 1px solid #23344a;
            border-radius: 18px;
            padding: 25px;
        }

        .card h2 {
            color: #00d9ff;
            font-size: 13px;
            letter-spacing: 2px;
            margin-top: 0;
            margin-bottom: 25px;
        }

        .row {
            padding: 15px 0;
            border-bottom: 1px solid #1b293a;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            display: block;
            color: #647994;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 7px;
        }

        .value {
            color: #dce6f2;
            word-break: break-word;
        }

        .role {
            display: inline-block;
            padding: 7px 14px;
            border: 1px solid #00d9ff;
            border-radius: 20px;
            color: #00d9ff;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: bold;
        }

        .security {
            margin-top: 22px;
        }

        .status {
            color: #00e28a;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }

        .btn {
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 10px;
            border: 1px solid #29415c;
            color: #dce6f2;
            background: #0b1320;
        }

        .btn:hover {
            border-color: #00d9ff;
            color: #00d9ff;
        }

        @media (max-width: 700px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .profile-header {
                flex-direction: column;
                align-items: flex-start;
            }

            h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h1>My Profile</h1>

    <div class="subtitle">
        SecureCloud identity and account information
    </div>

    <div class="profile-header">

        <div class="avatar">
            {{ $avatarLetter }}
        </div>

        <div>
            <div class="name">
                {{ $name }}
            </div>

            <div class="email">
                {{ $email }}
            </div>

            @if($verified)
                <span class="verified">
                    ● EMAIL VERIFIED
                </span>
            @endif
        </div>

    </div>

    <div class="grid">

        <div class="card">

            <h2>COGNITO IDENTITY</h2>

            <div class="row">
                <span class="label">Name</span>
                <span class="value">
                    {{ $name }}
                </span>
            </div>

            <div class="row">
                <span class="label">Email</span>
                <span class="value">
                    {{ $email }}
                </span>
            </div>

            <div class="row">
                <span class="label">Username</span>
                <span class="value">
                    {{ $username }}
                </span>
            </div>

            <div class="row">
                <span class="label">Cognito User ID</span>
                <span class="value">
                    {{ $sub }}
                </span>
            </div>

        </div>

        <div class="card">

            <h2>SECURECLOUD ACCOUNT</h2>

            <div class="row">
                <span class="label">Local User ID</span>
                <span class="value">
                    {{ $localUserId }}
                </span>
            </div>

            <div class="row">
                <span class="label">Account Role</span>

                <span class="role">
                    {{ $role }}
                </span>
            </div>

            <div class="row">
                <span class="label">Identity Provider</span>
                <span class="value">
                    AWS Cognito
                </span>
            </div>

            <div class="row">
                <span class="label">Authentication</span>
                <span class="value status">
                    ● Authenticated
                </span>
            </div>

        </div>

    </div>

    <div class="card security">

        <h2>SECURITY STATUS</h2>

        <div class="row">
            <span class="label">Account Security</span>

            <span class="value status">
                ● Active
            </span>
        </div>

        <div class="row">
            <span class="label">Authentication Provider</span>

            <span class="value">
                AWS Cognito OAuth 2.0 / OIDC
            </span>
        </div>

    </div>

    <div class="actions">

        <a href="/dashboard" class="btn">
            ← Dashboard
        </a>

        <a href="/logout" class="btn">
            Logout
        </a>

    </div>

</div>

</body>
</html>
