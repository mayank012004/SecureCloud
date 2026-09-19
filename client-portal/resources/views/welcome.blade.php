<!DOCTYPE html>
<html>
<head>
    <title>Employee Portal</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #070b12;
            color: white;
        }

        nav {
            height: 70px;
            padding: 0 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #1d2938;
            background: #090e16;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
        }

        .logo span {
            color: #00d9ff;
        }

        .status {
            color: #35e88b;
            font-size: 13px;
        }

        main {
            max-width: 1100px;
            margin: 70px auto;
            padding: 0 30px;
        }

        h1 {
            font-size: 42px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #8da0b8;
            font-size: 17px;
            margin-bottom: 45px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .card {
            background: #0c121c;
            border: 1px solid #1d2938;
            border-radius: 12px;
            padding: 30px;
        }

        .card h2 {
            font-size: 17px;
            margin-top: 0;
            color: #9bb0c9;
        }

        .card p {
            color: #d5deea;
            line-height: 1.6;
        }

        .protected {
            margin-top: 35px;
            padding: 25px;
            border-left: 3px solid #00d9ff;
            background: #0b111a;
        }

        .protected strong {
            color: #00d9ff;
        }

        @media (max-width: 800px) {
            .grid {
                grid-template-columns: 1fr;
            }

            nav {
                padding: 0 20px;
            }

            main {
                margin-top: 40px;
            }
        }
    </style>
</head>

<body>

<nav>
    <div class="logo">
        Secure<span>Cloud</span>
    </div>

    <div class="status">
        ● Connected
    </div>
</nav>

<main>

    <h1>Employee Portal</h1>

    <div class="subtitle">
        Secure company application powered by SecureCloud
    </div>

    <div class="grid">

        <div class="card">
            <h2>My Profile</h2>
            <p>
                View and manage your employee information.
            </p>
        </div>

        <div class="card">
            <h2>Company Resources</h2>
            <p>
                Access authorized company documents and resources.
            </p>
        </div>

        <div class="card">
            <h2>Security</h2>
            <p>
                Your account is protected by SecureCloud authentication.
            </p>
        </div>

    </div>

    <div class="protected">
        <strong>SECURE CONNECTION</strong>
        <p>
            Authentication and access control are handled through
            SecureCloud and AWS Cognito.
        </p>
    </div>

</main>

</body>
</html>
