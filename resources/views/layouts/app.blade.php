<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Santara - Cerita Rakyat Nusantara')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>
        {{-- Example: search hero with background --}}
        @hasSection('search')
            <section class="search-container search-background search-hero">
                <div class="container">
                    @yield('search')
                </div>
            </section>
        @endif

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container navbar-content">
            <div class="nav-left">
                <!-- Hamburger Menu -->
                <div class="hamburger-menu-wrapper">
                    <button class="hamburger-toggle" id="hamburgerToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div class="hamburger-dropdown" id="hamburgerDropdown">
                        @guest
                        <a href="{{ route('admin.login') }}">
                            Login as Admin
                        </a>
                        <div class="dropdown-divider"></div>
                        @endguest
                        <div class="filter-section">
                            <button class="filter-header" id="filterToggle">
                                Filter Kategori Cerita
                                <span class="filter-arrow">▼</span>
                            </button>
                            <div class="region-list" id="regionList" style="display: none;">
                                <a href="{{ route('home') }}">Semua Region</a>
                                @foreach($regions as $region)
                                    <a href="{{ route('home', ['region' => $region->name]) }}">
                                        {{ $region->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">S</div>
                    <span>Santara</span>
                </a>
            </div>

            <div class="nav-right">
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard Admin</a></li>
                        @endif
                        
                        <li>
                            <span class="nav-user">Halo, {{ auth()->user()->name }}</span>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        <li><a href="{{ route('register') }}" class="nav-link">Daftar</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container" style="margin-top: 20px;">
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer footer-background">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="logo">
                        <div class="logo-icon">S</div>
                        <span>Santara</span>
                    </div>
                    <p style="margin-top: 1rem;">Platform cerita rakyat dan legenda nusantara untuk melestarikan warisan budaya Indonesia.</p>
                </div>
                
                <div class="footer-section">
                    <h3>Tentang</h3>
                    <p>Santara adalah platform digital untuk melestarikan dan membagikan cerita rakyat nusantara kepada generasi muda.</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Santara. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>