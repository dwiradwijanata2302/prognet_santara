<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Santara')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="logo">
                <div class="logo-icon">S</div>
                <span>Santara Admin</span>
            </div>

            <ul class="admin-nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        📊 Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.stories.index') }}" class="{{ request()->routeIs('admin.stories.*') ? 'active' : '' }}">
                        📚 Kelola Cerita
                    </a>
                </li>
                <li>
                    <a href="{{ route('home') }}">
                        🌐 Lihat Website
                    </a>
                </li>
            </ul>

            <div style="padding: 1.5rem; border-top: 1px solid #374151; margin-top: 2rem;">
                <p style="margin-bottom: 1rem;"><strong>{{ auth()->user()->name }}</strong></p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="admin-main">
            <header class="admin-header">
                <h1>@yield('page-title', 'Dashboard')</h1>
            </header>

            <!-- Flash Messages -->
            @if(session('success'))
                <div style="padding: 0 2rem; margin-top: 1rem;">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div style="padding: 0 2rem; margin-top: 1rem;">
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>