<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Admin Dashboard') | Alumni Portal</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-navy: #eff5f8;
            --accent-gold: darkblue;
            --hover-blue: #1e293b;
            --bg-light: #f8fafc;
            --text-gray: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-light);
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--primary-navy);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding: 15px 0;
            z-index: 1000;
        }

        .sidebar-brand {
            margin-top: 10px;
            padding: 0 25px 30px;
            font-size: 1.25rem;
            font-weight: 700;
            color:darkblue;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .nav-menu {
            list-style: none;
            flex-grow: 1;
        }

        .nav-item {
            margin: 4px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: black;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s;
            font-weight: 500;
        }

        .nav-link i {
            width: 25px;
            font-size: 1.1rem;
            margin-right: 12px;
        }

        .nav-link:hover, .nav-link.active {
            background-color: var(--hover-blue);
            color: white;
        }

        .nav-link.active {
            border-left: 4px solid var(--accent-gold);
            background-color: rgba(181, 147, 91, 0.1);
        }

        /* Top Header Styling */
        .top-header {
            position: fixed;
            top: 0;
            right: 0;
            width: calc(100% - var(--sidebar-width));
            height: 70px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 40px;
            z-index: 900;
        }

        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: 70px;
            width: 100%;
            padding: 40px;
            min-height: calc(100vh - 70px);
        }

        .footer {
            margin-top: auto;
            padding: 20px 25px;
            font-size: 0.8rem;
            color: var(--text-gray);
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .logout-link {
            color: #ef4444 !important;
        }

        .logout-link:hover {
            background-color: rgba(239, 68, 68, 0.1) !important;
        }
    </style>

    @stack('css')
</head>
<body>

    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-graduation-cap"><small>Alumni Tracker</small></i>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
            </li>
             <li class="nav-item">
                <a href="{{ route('change.password') }}" class="nav-link">
                    <i class="fas fa-key"></i> Change Password
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('alumni.member') }}" class="nav-link {{ request()->is('admin/members*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Alumni Member
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('alumni.pending') }}" class="nav-link {{ request()->is('admin/pending*') ? 'active' : '' }}">
                    <i class="fas fa-user-clock"></i> Pending Request
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('alumni.announcement') }}" class="nav-link {{ request()->is('admin/announcements*') ? 'active' : '' }}">
                    <i class="fas fa-bullhorn"></i> Announcement
                </a>
            </li>
           
            <li class="nav-item">
                <a href="#" class="nav-link logout-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>

        <div class="footer">
            &copy; {{ date('Y') }} RTM-AKTU|SAC
        </div>
    </aside>

    <header class="top-header">
        <div style="font-weight: 600; font-size: 0.9rem;">
            Welcome, System Admin <i class="fas fa-user-circle" style="margin-left: 10px; font-size: 1.2rem;"></i>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    @stack('js')
</body>
</html>