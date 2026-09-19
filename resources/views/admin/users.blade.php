<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SecureCloud | Users</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #05070b;
            color: #f1f5f9;
            font-family: Arial, Helvetica, sans-serif;
        }

        nav {
            height: 72px;
            border-bottom: 1px solid #17202c;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            background: #03050a;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .logo span {
            color: #00d9ff;
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-links a:hover {
            color: #00d9ff;
        }

        .nav-links .active {
            color: #00d9ff;
        }

        .container {
            max-width: 1150px;
            margin: 0 auto;
            padding: 70px 25px;
        }

        .eyebrow {
            color: #00d9ff;
            letter-spacing: 5px;
            font-size: 11px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 48px;
            margin: 0 0 12px;
        }

        .subtitle {
            color: #7890aa;
            font-size: 16px;
            margin-bottom: 40px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 10px 18px;
            border: 1px solid #075b67;
            border-radius: 30px;
            color: #27e6ad;
            font-size: 12px;
            margin-bottom: 35px;
        }

        .dot {
            width: 7px;
            height: 7px;
            background: #27e6ad;
            border-radius: 50%;
        }

        .success {
            background: rgba(39, 230, 173, 0.08);
            border: 1px solid rgba(39, 230, 173, 0.35);
            color: #27e6ad;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .error {
            background: rgba(255, 82, 82, 0.08);
            border: 1px solid rgba(255, 82, 82, 0.35);
            color: #ff6b6b;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .user-card {
            background: linear-gradient(145deg, #0a1018, #070b11);
            border: 1px solid #1d2b3a;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 22px;
        }

        .user-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .user-name {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .email {
            color: #6f849c;
            font-size: 14px;
        }

        .role {
            padding: 8px 15px;
            border: 1px solid #00d9ff;
            border-radius: 20px;
            color: #00d9ff;
            font-size: 11px;
            letter-spacing: 1px;
        }

        /* ACCOUNT STATUS */

        .account-status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 13px;
            border-radius: 20px;
            font-size: 10px;
            letter-spacing: 1px;
            font-weight: bold;
            margin-top: 12px;
        }

        .account-status.active {
            color: #27e6ad;
            border: 1px solid rgba(39, 230, 173, 0.35);
            background: rgba(39, 230, 173, 0.06);
        }

        .account-status.blocked {
            color: #ff6b6b;
            border: 1px solid rgba(255, 82, 82, 0.35);
            background: rgba(255, 82, 82, 0.06);
        }

        .status-small-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .active .status-small-dot {
            background: #27e6ad;
            box-shadow: 0 0 8px rgba(39, 230, 173, 0.8);
        }

        .blocked .status-small-dot {
            background: #ff6b6b;
            box-shadow: 0 0 8px rgba(255, 82, 82, 0.8);
        }

        /* USER INFORMATION */

        .info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 25px;
        }

        .info-box {
            background: #080d14;
            border: 1px solid #182536;
            border-radius: 12px;
            padding: 18px;
        }

        .label {
            color: #62758b;
            font-size: 10px;
            letter-spacing: 2px;
            margin-bottom: 8px;
        }

        .value {
            color: #dce7f3;
            font-size: 14px;
        }

        /* APPLICATION ACCESS */

        .applications-section {
            margin-top: 28px;
            padding-top: 25px;
            border-top: 1px solid #182536;
        }

        .applications-title {
            font-size: 13px;
            letter-spacing: 2px;
            color: #00d9ff;
            margin-bottom: 18px;
        }

        .applications-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .application-item {
            display: flex;
            align-items: center;
            gap: 13px;
            background: #080d14;
            border: 1px solid #182536;
            border-radius: 10px;
            padding: 16px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .application-item:hover {
            border-color: #00d9ff;
            background: #0b121b;
        }

        .application-item input {
            width: 18px;
            height: 18px;
            accent-color: #00d9ff;
            cursor: pointer;
        }

        .application-name {
            font-size: 14px;
            color: #dce7f3;
        }

        .application-id {
            display: block;
            color: #62758b;
            font-size: 10px;
            margin-top: 4px;
        }

        .save-btn {
            margin-top: 22px;
            padding: 13px 25px;
            background: #00d9ff;
            color: #001018;
            border: none;
            border-radius: 9px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #38e8ff;
        }

        /* BLOCK / UNBLOCK */

        .user-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 25px;
            padding-top: 22px;
            border-top: 1px solid #182536;
        }

        .action-label {
            color: #62758b;
            font-size: 10px;
            letter-spacing: 2px;
            margin-right: 5px;
        }

        .user-actions form {
            margin: 0;
        }

        .block-btn,
        .unblock-btn {
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .block-btn {
            background: rgba(255, 82, 82, 0.08);
            color: #ff6b6b;
            border: 1px solid rgba(255, 82, 82, 0.35);
        }

        .block-btn:hover {
            background: rgba(255, 82, 82, 0.16);
            border-color: #ff6b6b;
        }

        .unblock-btn {
            background: rgba(39, 230, 173, 0.08);
            color: #27e6ad;
            border: 1px solid rgba(39, 230, 173, 0.35);
        }

        .unblock-btn:hover {
            background: rgba(39, 230, 173, 0.16);
            border-color: #27e6ad;
        }

        .empty-apps {
            padding: 20px;
            border: 1px dashed #263545;
            border-radius: 10px;
            color: #71849a;
            font-size: 13px;
        }

        .empty {
            padding: 40px;
            text-align: center;
            border: 1px dashed #263545;
            border-radius: 15px;
            color: #71849a;
        }

        @media (max-width: 750px) {

            .info {
                grid-template-columns: 1fr;
            }

            .applications-grid {
                grid-template-columns: 1fr;
            }

            .user-top {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-actions {
                flex-direction: column;
                align-items: flex-start;
            }

            h1 {
                font-size: 36px;
            }

            nav {
                padding: 0 20px;
            }

            .nav-links {
                gap: 12px;
            }
        }
    </style>
</head>

<body>

<nav>

    <div class="logo">
        Secure<span>Cloud</span>
    </div>

    <div class="nav-links">
        <a href="/dashboard">DASHBOARD</a>
        <a href="/applications">APPLICATIONS</a>
        <a href="/users" class="active">USERS</a>
        <a href="/profile">PROFILE</a>
        <a href="/admin">ADMIN</a>
        <a href="/logout">LOGOUT</a>
    </div>

</nav>

<div class="container">

    <div class="eyebrow">
        ADMINISTRATION • USER MANAGEMENT
    </div>

    <h1>SecureCloud Users</h1>

    <div class="subtitle">
        Manage registered users and control their application access.
    </div>

    <div class="status">
        <span class="dot"></span>
        USER ACCESS MANAGEMENT ACTIVE
    </div>

    @if(session('success'))
        <div class="success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            ⚠ {{ session('error') }}
        </div>
    @endif

    @forelse ($users as $user)

        @php
            $assignedIds = isset($userApplications[$user->id])
                ? $userApplications[$user->id]->pluck('application_id')->toArray()
                : [];
        @endphp

        <div class="user-card">

            <div class="user-top">

                <div>

                    <div class="user-name">
                        {{ $user->name }}
                    </div>

                    <div class="email">
                        {{ $user->email }}
                    </div>

                    @if($user->is_active)

                        <div class="account-status active">
                            <span class="status-small-dot"></span>
                            ACTIVE
                        </div>

                    @else

                        <div class="account-status blocked">
                            <span class="status-small-dot"></span>
                            BLOCKED
                        </div>

                    @endif

                </div>

                <div class="role">
                    {{ strtoupper($user->role) }}
                </div>

            </div>

            <div class="info">

                <div class="info-box">
                    <div class="label">USER ID</div>

                    <div class="value">
                        {{ $user->id }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="label">ROLE</div>

                    <div class="value">
                        {{ ucfirst($user->role) }}
                    </div>
                </div>

                <div class="info-box">
                    <div class="label">REGISTERED</div>

                    <div class="value">
                        {{ $user->created_at }}
                    </div>
                </div>

            </div>

            <div class="applications-section">

                <div class="applications-title">
                    APPLICATION ACCESS
                </div>

                @if($applications->count() > 0)

                    <form
                        method="POST"
                        action="{{ route('admin.user-applications.update', $user->id) }}"
                    >

                        @csrf

                        @method('PUT')

                        <div class="applications-grid">

                            @foreach($applications as $application)

                                <label class="application-item">

                                    <input
                                        type="checkbox"
                                        name="application_ids[]"
                                        value="{{ $application->id }}"
                                        {{ in_array($application->id, $assignedIds) ? 'checked' : '' }}
                                    >

                                    <div>
                                        <div class="application-name">
                                            {{ $application->name }}
                                        </div>

                                        <span class="application-id">
                                            APPLICATION ID: {{ $application->id }}
                                        </span>
                                    </div>

                                </label>

                            @endforeach

                        </div>

                        <button type="submit" class="save-btn">
                            SAVE ACCESS
                        </button>

                    </form>

                @else

                    <div class="empty-apps">
                        No applications have been registered in SecureCloud yet.
                    </div>

                @endif

            </div>

            <div class="user-actions">

                <span class="action-label">
                    ACCOUNT CONTROL
                </span>

                @if($user->is_active)

                    <form
                        method="POST"
                        action="{{ route('users.block', $user->id) }}"
                        onsubmit="return confirm('Are you sure you want to block this user? This will prevent the user from accessing SecureCloud.');"
                    >

                        @csrf

                        <button type="submit" class="block-btn">
                            🔒 BLOCK USER
                        </button>

                    </form>

                @else

                    <form
                        method="POST"
                        action="{{ route('users.unblock', $user->id) }}"
                        onsubmit="return confirm('Are you sure you want to unblock this user?');"
                    >

                        @csrf

                        <button type="submit" class="unblock-btn">
                            🔓 UNBLOCK USER
                        </button>

                    </form>

                @endif

            </div>

        </div>

    @empty

        <div class="empty">
            No users are currently registered in SecureCloud.
        </div>

    @endforelse

</div>

</body>
</html>
