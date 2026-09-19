<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Application Access | SecureCloud</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #03060b;
            color: #e6f1ff;
            font-family: Arial, sans-serif;
        }

        .navbar {
            height: 72px;
            border-bottom: 1px solid #172333;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 38px;
            background: #050911;
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
            gap: 28px;
        }

        .nav-links a {
            color: #91a5bd;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-links a:hover {
            color: #00d9ff;
        }

        .container {
            max-width: 1150px;
            margin: 50px auto;
            padding: 0 25px;
        }

        .header {
            margin-bottom: 35px;
        }

        .header h1 {
            margin: 0 0 10px;
            font-size: 38px;
        }

        .header p {
            color: #8193aa;
            font-size: 16px;
        }

        .success {
            background: rgba(0, 255, 150, 0.08);
            border: 1px solid rgba(0, 255, 150, 0.35);
            color: #00f5a0;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 25px;
        }

        .card {
            background: #080e17;
            border: 1px solid #1b2b3d;
            border-radius: 14px;
            padding: 28px;
            margin-bottom: 25px;
        }

        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .user-info h2 {
            margin: 0 0 7px;
            font-size: 21px;
        }

        .user-info p {
            margin: 0;
            color: #8193aa;
            font-size: 14px;
        }

        .role {
            padding: 6px 12px;
            border: 1px solid #00d9ff;
            border-radius: 20px;
            color: #00d9ff;
            font-size: 12px;
            text-transform: uppercase;
        }

        .applications {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .application {
            border: 1px solid #203247;
            border-radius: 10px;
            padding: 18px;
            background: #050a11;
            transition: 0.2s;
        }

        .application:hover {
            border-color: #00d9ff;
        }

        .application label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
        }

        .application input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: #00d9ff;
        }

        .app-name {
            font-weight: bold;
            margin-bottom: 6px;
        }

        .app-description {
            color: #71849a;
            font-size: 13px;
            line-height: 1.5;
        }

        .save-area {
            margin-top: 25px;
            display: flex;
            justify-content: flex-end;
        }

        .save-btn {
            background: #00d9ff;
            color: #001018;
            border: none;
            padding: 11px 22px;
            border-radius: 7px;
            font-weight: bold;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #54e7ff;
        }

        .empty {
            text-align: center;
            color: #71849a;
            padding: 50px;
        }

        @media (max-width: 800px) {
            .applications {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 0 20px;
            }

            .nav-links {
                gap: 12px;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">

    <div class="logo">
        Secure<span>Cloud</span>
    </div>

    <div class="nav-links">
        <a href="/dashboard">Dashboard</a>
        <a href="/profile">Profile</a>
        <a href="/admin">Admin</a>
        <a href="/logout">Logout</a>
    </div>

</nav>


<div class="container">

    <div class="header">

        <h1>Application Access</h1>

        <p>
            Control which company applications each user can access.
        </p>

    </div>


    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @forelse ($users as $user)

        <div class="card">

            <div class="user-header">

                <div class="user-info">

                    <h2>
                        {{ $user->name }}
                    </h2>

                    <p>
                        {{ $user->email }}
                    </p>

                </div>

                <div class="role">
                    {{ $user->role }}
                </div>

            </div>


            <form
                method="POST"
                action="{{ route('admin.applications.update', $user) }}"
            >

                @csrf

                @method('PUT')


                <div class="applications">

                    @foreach ($applications as $application)

                        <div class="application">

                            <label>

                                <input
                                    type="checkbox"
                                    name="applications[]"
                                    value="{{ $application->id }}"
                                    {{ $user->applications->contains($application->id) ? 'checked' : '' }}
                                >

                                <div>

                                    <div class="app-name">
                                        {{ $application->name }}
                                    </div>

                                    <div class="app-description">
                                        {{ $application->description }}
                                    </div>

                                </div>

                            </label>

                        </div>

                    @endforeach

                </div>


                <div class="save-area">

                    <button
                        type="submit"
                        class="save-btn"
                    >
                        SAVE ACCESS
                    </button>

                </div>

            </form>

        </div>

    @empty

        <div class="card empty">
            No users found.
        </div>

    @endforelse

</div>

</body>
</html>
