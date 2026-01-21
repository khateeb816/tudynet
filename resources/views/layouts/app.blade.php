<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="{{ asset('assets/images/logo.jpeg') }}" rel="icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tudynet')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            /* Updated Theme Color to Logo Red (#8B0000) */
            --primary-color: #8B0000;
            --sidebar-bg: #2c3e50;
            --sidebar-active: #8B0000;
        }
        body {
            background-color: #f0f2f5;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            color: #fff;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 0.2rem;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: var(--primary-color);
            font-weight: bold;
        }
        .sidebar .nav-link i {
            width: 1.5rem;
            text-align: center;
        }
        /* Mobile Sidebar (Offcanvas) Styles */
        .offcanvas {
            background-color: var(--sidebar-bg);
        }
        .offcanvas .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
        }
        .offcanvas .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .offcanvas .nav-link.active {
            color: #fff;
            background-color: var(--primary-color);
        }
        /* Logo Container */
        .sidebar-logo-container {
            background-color: transparent;
            padding: 0;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .sidebar-logo-container img {
            width: 100%;
            height: auto;
            max-height: 100px; /* Increased from 60px to fit better */
            object-fit: contain; /* or cover, depending on exact logo shape preference */
            display: block;
        }
        .main-content {
            padding: 30px;
        }
        .header {
            background: #fff;
            padding: 20px 30px;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.02);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background-color: #600000;
            border-color: #600000;
        }
        .table-container {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }
    </style>
    @yield('styles')
</head>
<body>
<body>
    <div class="container-fluid">
        <div class="row">
            @auth
            <!-- Desktop Sidebar -->
            <div class="col-md-2 sidebar d-none d-md-block">
                @include('layouts.sidebar')
            </div>

            <!-- Mobile Offcanvas Sidebar -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel" style="background-color: var(--sidebar-bg); width: 250px;">
                <div class="offcanvas-header border-bottom border-secondary">
                    <h5 class="offcanvas-title text-white" id="mobileSidebarLabel">Menu</h5>
                    <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body p-0">
                    @include('layouts.sidebar')
                </div>
            </div>

            <div class="col-md-10 main-content ms-auto">
                <div class="header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-link text-dark me-3 d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                            <i class="bi bi-list fs-3"></i>
                        </button>
                        <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3 dropdown">
                            <a href="#" class="text-decoration-none text-dark position-relative" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="markNotificationsRead()">
                                <i class="bi bi-bell fs-5"></i>
                                @if(isset($unreadNotificationsCount) && $unreadNotificationsCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge">
                                    {{ $unreadNotificationsCount }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                                <li class="p-2 border-bottom bg-light">
                                    <h6 class="mb-0">Notifications</h6>
                                </li>
                                @if(isset($topNotifications) && count($topNotifications) > 0)
                                    @foreach($topNotifications as $notification)
                                    <li>
                                        <a class="dropdown-item p-3 border-bottom" href="{{ $notification->order_id ? route('orders.show', $notification->order_id) : route('notifications.index') }}">
                                            <p class="mb-1 text-wrap small">{{ $notification->message }}</p>
                                            <small class="text-muted" style="font-size: 0.75rem;">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </small>
                                        </a>
                                    </li>
                                    @endforeach
                                    <li><a class="dropdown-item text-center p-2 text-primary small fw-bold" href="{{ route('notifications.index') }}">View All Notifications</a></li>
                                @else
                                    <li class="p-3 text-center text-muted small">No new notifications</li>
                                    <li><a class="dropdown-item text-center p-2 text-primary small fw-bold" href="{{ route('notifications.index') }}">View All Notifications</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link text-dark text-decoration-none dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                                <span class="d-none d-md-inline">{{ auth()->user()->name }} ({{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }})</span>
                                <span class="d-md-none"><i class="bi bi-person-circle fs-4"></i></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <script>
                    function markNotificationsRead() {
                        const badge = document.getElementById('notificationBadge');
                        if (badge) {
                            badge.style.display = 'none';
                        }
                        
                        fetch("{{ route('notifications.mark-all-read') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            }
                        });
                    }
                </script>
            @endauth

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')

            @auth
            </div>
            @endauth
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>

