<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SecureCloud Admin</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #05070d;
            color: #e8edf7;
            font-family: Arial, sans-serif;
        }

        nav {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 42px;
            border-bottom: 1px solid #1d2738;
            background: #070a11;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .logo span {
            color: #00d9ff;
        }

        nav a {
            color: #9ba9c1;
            text-decoration: none;
            margin-left: 28px;
            font-size: 14px;
        }

        nav a:hover {
            color: #00d9ff;
        }

        nav a.active {
            color: #00d9ff;
        }

        .container {
            max-width: 1250px;
            margin: 0 auto;
            padding: 42px;
        }

        h1 {
            font-size: 38px;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #8ea0bb;
            margin-bottom: 18px;
        }

        .admin-badge {
            display: inline-block;
            padding: 9px 16px;
            border: 1px solid #00d9ff;
            border-radius: 30px;
            color: #00d9ff;
            font-size: 13px;
            margin-bottom: 34px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: #0a0f18;
            border: 1px solid #202d40;
            border-radius: 14px;
            padding: 26px;
        }

        .card-title {
            color: #8ea0bb;
            font-size: 13px;
            font-weight: bold;
        }

        .number {
            font-size: 32px;
            color: #00d9ff;
            margin-top: 14px;
        }

        .secure {
            color: #21e982;
        }

        .events {
            background: #0a0f18;
            border: 1px solid #202d40;
            border-radius: 14px;
            padding: 26px;
        }

        .events h2 {
            margin-top: 0;
            margin-bottom: 25px;
        }

        .event {
            padding: 20px 0;
            border-bottom: 1px solid #1d2738;
        }

        .event:last-child {
            border-bottom: none;
        }

        .event-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #21e982;
            margin-right: 8px;
        }

        .event-description {
            color: #9fb0ca;
            margin-bottom: 8px;
        }

        .meta {
            color: #60728f;
            font-size: 12px;
            line-height: 1.7;
        }

        .risk {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            margin-left: 8px;
            font-weight: bold;
        }

        .risk-low {
            color: #21e982;
            border: 1px solid #21e982;
        }

        .risk-medium {
            color: #ffc83d;
            border: 1px solid #ffc83d;
        }

        .risk-high {
            color: #ff4d5e;
            border: 1px solid #ff4d5e;
        }

        .analysis {
            margin-top: 16px;
            padding: 16px;
            background: #080c14;
            border-left: 3px solid #00d9ff;
            border-radius: 6px;
        }

        .analysis-title {
            color: #00d9ff;
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .analysis p {
            margin: 5px 0;
            color: #aab8cc;
            font-size: 13px;
        }

        .recommendation {
            color: #e8edf7 !important;
        }

        .event-type-access {
            color: #00d9ff;
        }

        .event-type-login {
            color: #21e982;
        }

        .empty {
            color: #71819a;
            padding: 20px 0;
        }

        @media (max-width: 1000px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 800px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 25px;
            }

            nav {
                padding: 0 20px;
            }

            nav a {
                margin-left: 10px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

<nav>

    <div class="logo">
        Secure<span>Cloud</span>
    </div>

    <div>

        <a href="/dashboard">
            Dashboard
        </a>

        <a href="/applications">
            Applications
        </a>

        <a href="/users">
            Users
        </a>

        <a href="/profile">
            Profile
        </a>

        <a href="/admin" class="active">
            Admin
        </a>

        <a href="/logout">
            Logout
        </a>

    </div>

</nav>


<div class="container">

    <h1>Admin Dashboard</h1>

    <div class="subtitle">
        Security and access management control center
    </div>

    <div class="admin-badge">
        ● ADMIN ACCESS
    </div>


    <div class="cards">

        <!-- TOTAL USERS -->

        <div class="card">

            <div class="card-title">
                TOTAL USERS
            </div>

            <div class="number">
                {{ \App\Models\User::where('role', '!=', 'admin')->count() }}
            </div>

        </div>


        <!-- APPLICATIONS -->

        <div class="card">

            <div class="card-title">
                APPLICATIONS
            </div>

            <div class="number">
                {{ \App\Models\Application::where('status', 'active')->count() }}
            </div>

        </div>


        <!-- ACTIVE ASSIGNMENTS -->

        <div class="card">

            <div class="card-title">
                ACTIVE ASSIGNMENTS
            </div>

            <div class="number">
                {{ \Illuminate\Support\Facades\DB::table('user_applications')->count() }}
            </div>

        </div>


        <!-- SECURITY EVENTS -->

        <div class="card">

            <div class="card-title">
                SECURITY EVENTS
            </div>

            <div class="number">
                {{ \App\Models\SecurityEvent::count() }}
            </div>

        </div>

    </div>


    <!-- SECURITY EVENTS -->

    <div class="events">

        <h2>
            Recent Security Events
        </h2>


        @php

            $events = \App\Models\SecurityEvent::with('user')
                ->latest()
                ->take(10)
                ->get();

        @endphp


        @forelse($events as $event)

            <div class="event">

                <div class="event-title">

                    <span class="dot"></span>

                    <span class="
                        @if($event->event_type === 'APP_ACCESS_GRANTED' || $event->event_type === 'APP_ACCESS_REVOKED')
                            event-type-access
                        @elseif($event->event_type === 'login_success')
                            event-type-login
                        @endif
                    ">

                        {{ strtoupper($event->event_type) }}

                    </span>


                    <span class="risk risk-{{ $event->risk_level }}">
                        {{ strtoupper($event->risk_level) }}
                    </span>

                </div>


                <div class="event-description">

                    {{ $event->description }}

                </div>


                <div class="meta">

                    <strong>User:</strong>
                    {{ $event->user->email ?? 'Unknown' }}

                    &nbsp; | &nbsp;

                    <strong>IP:</strong>
                    {{ $event->ip_address }}

                    &nbsp; | &nbsp;

                    <strong>Time:</strong>
                    {{ $event->created_at }}

                    <br>

                    <strong>User Agent:</strong>
                    {{ $event->user_agent }}

                </div>


                <div class="analysis">

                    <div class="analysis-title">
                        SECURITY ANALYSIS
                    </div>

                    <p>
                        {{ $event->security_analysis['summary'] }}
                    </p>

                    <p class="recommendation">

                        <strong>Recommendation:</strong>

                        {{ $event->security_analysis['recommendation'] }}

                    </p>

                </div>

            </div>

        @empty

            <div class="empty">
                No security events recorded yet.
            </div>

        @endforelse

    </div>

</div>

</body>
</html>
