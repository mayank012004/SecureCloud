<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SecureCloud — Login</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            background:
                radial-gradient(
                    circle at 20% 20%,
                    rgba(0, 217, 255, 0.08),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 80% 80%,
                    rgba(0, 100, 255, 0.08),
                    transparent 30%
                ),
                #05080f;

            color: #e8edf5;

            font-family: Arial, sans-serif;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .container {
            width: 100%;
            max-width: 460px;
            padding: 25px;
        }


        .brand {
            text-align: center;
            margin-bottom: 28px;
        }


        .logo {
            width: 70px;
            height: 70px;

            margin: 0 auto 16px;

            border-radius: 18px;

            background:
                linear-gradient(
                    135deg,
                    #00d9ff,
                    #087fa8
                );

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;
            font-weight: 800;

            color: white;

            box-shadow:
                0 0 30px rgba(0, 217, 255, 0.25);
        }


        .brand h1 {
            margin: 0;

            font-size: 30px;

            letter-spacing: 0.5px;
        }


        .brand p {
            margin-top: 8px;

            color: #6e8daf;

            font-size: 14px;
        }


        .card {

            background: rgba(8, 14, 25, 0.92);

            border: 1px solid #26364e;

            border-radius: 18px;

            padding: 34px;

            box-shadow:
                0 20px 60px rgba(0, 0, 0, 0.45);
        }


        .error-message {

            margin-bottom: 20px;

            padding: 14px 16px;

            border: 1px solid rgba(255, 70, 70, 0.45);

            border-radius: 10px;

            background: rgba(255, 40, 40, 0.08);

            color: #ff6b6b;

            font-size: 14px;

            line-height: 1.5;
        }


        .switch-account {

            display: inline-block;

            margin-top: 14px;

            padding: 10px 16px;

            border: 1px solid rgba(0, 200, 255, 0.45);

            border-radius: 8px;

            color: #00d9ff;

            text-decoration: none;

            font-size: 13px;

            font-weight: 600;

            transition: 0.2s ease;
        }


        .switch-account:hover {

            background: rgba(0, 217, 255, 0.08);

            border-color: #00d9ff;

            transform: translateY(-1px);
        }


        .success-message {

            margin-bottom: 20px;

            padding: 14px 16px;

            border: 1px solid rgba(0, 255, 170, 0.35);

            border-radius: 10px;

            background: rgba(0, 255, 170, 0.07);

            color: #00ffaa;

            font-size: 14px;

            line-height: 1.5;
        }


        .card-title {

            font-size: 24px;

            font-weight: 700;

            margin-bottom: 10px;
        }


        .card-subtitle {

            color: #7188a5;

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 28px;
        }


        .login-button {

            width: 100%;

            display: block;

            padding: 15px 18px;

            border-radius: 10px;

            background:
                linear-gradient(
                    135deg,
                    #09cce8,
                    #087fa8
                );

            color: white;

            text-decoration: none;

            text-align: center;

            font-size: 15px;

            font-weight: 700;

            transition: 0.2s ease;

            box-shadow:
                0 8px 25px rgba(0, 200, 255, 0.18);
        }


        .login-button:hover {

            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(0, 200, 255, 0.28);
        }


        .security-status {

            display: flex;

            align-items: center;

            gap: 8px;

            margin-top: 18px;

            color: #00e6a8;

            font-size: 12px;
        }


        .status-dot {

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #00e6a8;

            box-shadow:
                0 0 10px rgba(0, 230, 168, 0.7);
        }


        .security-box {

            margin-top: 28px;

            padding: 16px;

            border: 1px solid #26364e;

            border-radius: 12px;

            background: rgba(5, 10, 18, 0.6);
        }


        .security-title {

            color: #00d9ff;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 1.5px;

            margin-bottom: 10px;
        }


        .security-text {

            color: #66809e;

            font-size: 12px;

            line-height: 1.7;
        }


        .footer {

            margin-top: 28px;

            text-align: center;

            color: #40536b;

            font-size: 11px;
        }

    </style>

</head>


<body>

    <div class="container">

        <div class="brand">

            <div class="logo">
                SC
            </div>

            <h1>
                SecureCloud
            </h1>

            <p>
                Cloud-Based Authentication & Access Management
            </p>

        </div>


        <div class="card">


            {{-- Blocked / Error Message --}}

            @if(session('error'))

                <div class="error-message">

                    {{ session('error') }}

                    <a
                        href="/switch-account"
                        class="switch-account"
                    >
                        🔄 Sign in with another account
                    </a>

                </div>

            @endif


            {{-- Success Message --}}

            @if(session('success'))

                <div class="success-message">

                    {{ session('success') }}

                </div>

            @endif


            <div class="card-title">

                Welcome back

            </div>


            <div class="card-subtitle">

                Sign in securely to access your authorized
                applications and security dashboard.

            </div>


            <a
                href="/auth/cognito"
                class="login-button"
            >
                Sign in with AWS Cognito
            </a>


            <div class="security-status">

                <span class="status-dot"></span>

                Secure authentication enabled

            </div>


            <div class="security-box">

                <div class="security-title">

                    SECURITY LAYER

                </div>


                <div class="security-text">

                    Authentication is handled through AWS Cognito
                    using OAuth 2.0 and OpenID Connect.
                    SecureCloud applies role-based access control
                    and security event logging after authentication.

                </div>

            </div>


        </div>


        <div class="footer">

            SecureCloud • Identity & Access Management

        </div>

    </div>

</body>

</html>
