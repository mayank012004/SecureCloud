<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SecureCloud | Application Access</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background:
                radial-gradient(circle at 15% 20%, rgba(0, 212, 255, 0.08), transparent 30%),
                radial-gradient(circle at 85% 80%, rgba(120, 60, 255, 0.08), transparent 30%),
                #03060a;
            color: #f1f5f9;
            font-family: Arial, Helvetica, sans-serif;
            min-height: 100vh;
        }

        nav {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            border-bottom: 1px solid #17202c;
            background: rgba(3, 5, 10, 0.95);
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: -0.5px;
        }

        .logo span {
            color: #00d9ff;
        }

        .nav-links {
            display: flex;
            gap: 28px;
        }

        .nav-links a {
            color: #8ea0b8;
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 1px;
            transition: 0.2s;
        }

        .nav-links a:hover {
            color: #00d9ff;
        }

        .container {
            width: min(1050px, calc(100% - 40px));
            margin: 70px auto;
        }

        .eyebrow {
            color: #00d9ff;
            font-size: 12px;
            letter-spacing: 5px;
            margin-bottom: 18px;
        }

        h1 {
            font-size: 46px;
            margin: 0 0 12px;
        }

        .subtitle {
            color: #7790ad;
            font-size: 16px;
            margin-bottom: 35px;
        }

        .user-card {
            border: 1px solid #1d3045;
            border-radius: 18px;
            background: rgba(8, 14, 22, 0.8);
            padding: 28px;
            margin-bottom: 25px;
        }

        .user-label {
            color: #6d829d;
            font-size: 11px;
            letter-spacing: 3px;
            margin-bottom: 8px;
        }

        .user-name {
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .user-email {
            color: #7189a5;
        }

        .access-panel {
            border: 1px solid #1d3045;
            border-radius: 18px;
            background: rgba(8, 14, 22, 0.8);
            padding: 30px;
        }

        .panel-title {
            font-size: 21px;
            margin-bottom: 8px;
        }

        .panel-description {
            color: #7189a5;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .application {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px;
            margin-bottom: 15px;
            border: 1px solid #1d3045;
            border-radius: 14px;
            background: #070d14;
            transition: 0.2s;
        }

        .application:hover {
            border-color: #00bfe8;
            transform: translateY(-1px);
        }

        .application-info {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .app-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #075d73;
            color: #00d9ff;
            font-size: 20px;
        }

        .app-name {
            font-size: 17px;
            margin-bottom: 5px;
        }

        .app-description {
            color: #6f849c;
            font-size: 13px;
        }

        .switch {
            position: relative;
            width: 52px;
            height: 28px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            inset: 0;
            cursor: pointer;
            border-radius: 30px;
            background: #1a2633;
            border: 1px solid #33465b;
            transition: 0.25s;
        }

        .slider:before {
            content: "";
            position: absolute;
            width: 20px;
            height: 20px;
            left: 3px;
            top: 3px;
            background: #8ba0b7;
            border-radius: 50%;
            transition: 0.25s;
        }

        input:checked + .slider {
            background: #063d4d;
            border-color: #00d9ff;
        }

        input:checked + .slider:before {
            transform: translateX(24px);
            background: #00d9ff;
        }

        .save-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #172534;
        }

        .status {
            color: #31e6b1;
            font-size: 13px;
        }

        .save-btn {
            border: 0;
            border-radius: 10px;
            padding: 15px 28px;
            background: #00cfee;
            color: #021017;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.2s;
        }

        .save-btn:hover {
            background: #35ddf7;
            transform: translateY(-1px);
        }

        .success {
            margin-bottom: 25px;
            padding: 15px 18px;
            border-radius: 10px;
            border: 1px solid #12694f;
            background: rgba(18, 105, 79, 0.12);
            color: #42e6b6;
        }

        @media (max-width: 700px) {
            nav {
                padding: 0 20px;
            }

            .nav-links {
                gap: 12px;
            }

            .nav-links a {
                font-size: 11px;
            }

            h1 {
                font-size: 34px;
            }

            .application {
                gap: 15px;
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
        <a href="/users">USERS</a>
        <a href="/profile">PROFILE</a>
        <a href="/logout">LOGOUT</a>
    </div>
</nav>

<div class="container">

    <div class="eyebrow">
        ADMINISTRATION · ACCESS CONTROL
    </div>

    <h1>Application Access</h1>

    <div class="subtitle">
        Control which applications this user can access through SecureCloud.
    </div>

    @if (session('success'))
        <div class="success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="user-card">

        <div class="user-label">
            MANAGING USER
        </div>

        <div class="user-name">
            {{ $user->name }}
        </div>

        <div class="user-email">
            {{ $user->email }}
        </div>

    </div>

    <div class="access-panel">

        <div class="panel-title">
            Application Permissions
        </div>

        <div class="panel-description">
            Enable an application to grant this user access.
            Disable it to immediately remove the user's application permission.
        </div>

        <form
            method="POST"
            action="{{ route('admin.user-applications.update', $user->id) }}"
        >

            @csrf
            @method('PUT')

            @foreach ($applications as $id => $application)

                <div class="application">

                    <div class="application-info">

                        <div class="app-icon">
                            ◈
                        </div>

                        <div>
                            <div class="app-name">
                                {{ $application }}
                            </div>

                            <div class="app-description">
                                Company application protected by SecureCloud.
                            </div>
                        </div>

                    </div>

                    <label class="switch">

                        <input
                            type="checkbox"
                            name="applications[]"
                            value="{{ $id }}"
                            {{ in_array($id, $assignedApplications) ? 'checked' : '' }}
                        >

                        <span class="slider"></span>

                    </label>

                </div>

            @endforeach

            <div class="save-row">

                <div class="status">
                    ● ACCESS CONTROL ACTIVE
                </div>

                <button type="submit" class="save-btn">
                    SAVE ACCESS
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>
