<div class="sidebar-logo-container">
    <img src="{{ asset('assets/images/logo.jpeg') }}" alt="Logo" class="img-fluid">
</div>
<nav class="nav flex-column">
    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <i class="bi bi-house-door me-2"></i> Dashboard
    </a>
    <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
        <i class="bi bi-file-text me-2"></i> Orders
    </a>
    @if(auth()->user()->isSuperAdmin() || auth()->user()->isManager())
    <a class="nav-link {{ request()->routeIs('subjects.*') ? 'active' : '' }}" href="{{ route('subjects.index') }}">
        <i class="bi bi-book me-2"></i> Subjects
    </a>
    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
        <i class="bi bi-people me-2"></i> Users
    </a>
    @endif
    @if(auth()->user()->isSuperAdmin())
    <a class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}" href="{{ route('settings.index') }}">
        <i class="bi bi-gear me-2"></i> Settings
    </a>
    @endif
    <a class="nav-link {{ request()->routeIs('referrals.*') ? 'active' : '' }}" href="{{ route('referrals.index') }}">
        <i class="bi bi-share me-2"></i> Referrals
    </a>
    <a class="nav-link {{ request()->routeIs('notifications.index') ? 'active' : '' }}" href="{{ route('notifications.index') }}">
        <i class="bi bi-bell me-2"></i> Notifications
    </a>
</nav>
