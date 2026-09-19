<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SecureCloud | Applications</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 20% 20%, rgba(0, 180, 255, 0.08), transparent 30%),
                radial-gradient(circle at 80% 80%, rgba(120, 0, 255, 0.08), transparent 30%),
                #05070a;
            color: #ffffff;
            font-family: Arial, sans-serif;
        }

        .navbar {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 40px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            background: rgba(3, 5, 8, 0.92);
        }

        .logo {
            font-size: 22px;
            font-weight: 700;
            margin-right: auto;
            letter-spacing: 1px;
        }

        .logo span {
            color: #32d8ff;
        }

        .nav {
            display: flex;
            gap: 28px;
            align-items: center;
        }

        .nav a {
            color: #8f969f;
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 1px;
            transition: 0.2s;
        }

        .nav a:hover,
        .nav a.active {
            color: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 70px 35px;
        }

        .header {
            margin-bottom: 45px;
        }

        .eyebrow {
            color: #32d8ff;
            font-size: 11px;
            letter-spacing: 4px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 42px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .subtitle {
            color: #8f969f;
            font-size: 15px;
        }

        .security-status {
            margin-top: 25px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 9px 15px;
            border: 1px solid rgba(0, 255, 180, 0.25);
            border-radius: 20px;
            color: #66e6bc;
            font-size: 11px;
            letter-spacing: 1px;
            background: rgba(0, 255, 180, 0.04);
        }

        .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #27e6ad;
            box-shadow: 0 0 10px #27e6ad;
        }

        .apps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 22px;
        }

        .app-card {
            position: relative;
            padding: 28px;
            min-height: 230px;
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 16px;
            background: linear-gradient(
                145deg,
                rgba(20,25,31,0.95),
                rgba(7,10,14,0.95)
            );
            transition: transform 0.25s, border-color 0.25s;
            overflow: hidden;
        }

        .app-card::before {
            content: "";
            position: absolute;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(40, 210, 255, 0.06);
            filter: blur(30px);
            right: -50px;
            top: -50px;
        }

        .app-card:hover {
            transform: translateY(-5px);
            border-color: rgba(50,216,255,0.35);
        }

        .app-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 13px;
            background: rgba(50,216,255,0.08);
            border: 1px solid rgba(50,216,255,0.2);
            color: #32d8ff;
            font-size: 22px;
            margin-bottom: 24px;
        }

        .app-card h2 {
            font-size: 21px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .app-card p {
            color: #858c95;
            line-height: 1.6;
            font-size: 13px;
            min-height: 43px;
        }

        .app-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 25px;
        }

        .status {
            color: #55d8aa;
            font-size: 10px;
            letter-spacing: 1px;
        }

        .launch {
            text-decoration: none;
            color: #ffffff;
            border: 1px solid rgba(255,255,255,0.15);
            padding: 9px 16px;
            border-radius: 7px;
            font-size: 11px;
            letter-spacing: 1px;
            transition: 0.2s;
        }

        .launch:hover {
            background: rgba(50,216,255,0.1);
            border-color: rgba(50,216,255,0.4);
            color: #32d8ff;
        }

        .empty {
            padding: 50px;
            border: 1px dashed rgba(255,255,255,0.15);
            border-radius: 15px;
            text-align: center;
            color: #777f88;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 0 20px;
            }

            .nav {
                gap: 12px;
            }

            .nav a {
                font-size: 10px;
            }

            .container {
                padding: 45px 20px;
            }

            h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <div class="logo">
        Secure<span>Cloud</span>
    </div>

    <div class="nav">

        <a href="/dashboard">
            DASHBOARD
        </a>

        <a href="/applications" class="active">
            APPLICATIONS
        </a>

        <a href="/profile">
            PROFILE
        </a>

        @if (session('local_user_role') === 'admin')
            <a href="/admin">
                ADMIN
            </a>
        @endif

        <a href="/logout">
            LOGOUT
        </a>

    </div>

</nav>


<main class="container">

    <div class="header">

        <div class="eyebrow">
            SECURE APPLICATION GATEWAY
        </div>

        <h1>
            Applications
        </h1>

        <p class="subtitle">
            Access company applications through SecureCloud.
            Your available applications are determined by your assigned access permissions.
        </p>

        <div class="security-status">
            <span class="dot"></span>
            SECURE ACCESS CONTROL ACTIVE
        </div>

    </div>


    @if ($applications->count() > 0)

        <div class="apps-grid">

            @foreach ($applications as $application)

                <div class="app-card">

                    <div class="app-icon">
                        ◈
                    </div>

                    <h2>
                        {{ $application->name }}
                    </h2>

                    <p>
                        {{ $application->description }}
                    </p>

                    <div class="app-footer">

                        <span class="status">
                            ● {{ strtoupper($application->status) }}
                        </span>

                        <a
                            href="{{ route('applications.launch', $application) }}"
                            class="launch"
                        >
                            OPEN APP →
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty">

            <h2>No Applications Available</h2>

            <p style="margin-top: 10px;">
                You currently don't have access to any company applications.
            </p>

        </div>

    @endif

</main>

</body>
</html>
