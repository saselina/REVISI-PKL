@props(['title' => '', 'hideNavbar' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?: 'Sistem Aset' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        :root {
            --sidebar-width-collapsed: 70px;
            --sidebar-width-open: 260px;
            --primary-color: #647FBC;
            --background-light: #f4f7fe; /* Updated to the softer blue-grey */
            --text-color: #333;
            --active-bg: #F0F4FF;
        }

        body {
            margin: 0;
            background-color: var(--background-light);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }

        /* --- SIDEBAR LOGIC FROM CODE 1 --- */
        .sidebar-collapsed {
            position: fixed; top: 0; left: 0; width: var(--sidebar-width-collapsed);
            height: 100vh; background: #fff; box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding-top: 20px; display: flex; flex-direction: column; align-items: center; z-index: 1200;
            border-right: 1px solid #ddd;
        }

        .sidebar {
            height: 100%; width: 0; position: fixed; z-index: 1300; top: 0; left: 0;
            background: #fff; overflow-x: hidden; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar.open { width: var(--sidebar-width-open); }

        .sidebar a {
            display: flex; align-items: center; padding: 12px 20px; margin: 4px 12px;
            border-radius: 8px; font-size: 14px; color: var(--text-color); text-decoration: none; transition: 0.25s;
        }
        .sidebar a:hover { background: #f0f2f7; }

        .sidebar a.active, .mini-icon.active {
            background: var(--primary-color) !important;
            color: #fff !important;
        }

        .menu-header {
            padding: 20px 20px 5px; font-size: 11px; font-weight: bold; color: #aaa; letter-spacing: 1px; text-transform: uppercase;
        }

        .icon-placeholder {
            width: 26px; height: 26px; border-radius: 6px; display: flex;
            align-items: center; justify-content: center; margin-right: 12px;
            background: #e9ecf4; color: var(--primary-color); font-size: 14px;
        }
        .active .icon-placeholder { background: rgba(255,255,255,0.2); color: #fff; }

        .mini-icon {
            width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;
            font-size: 24px; text-decoration: none; margin-bottom: 15px; transition: 0.2s;
            color: var(--primary-color); border-radius: 8px;
        }
        .mini-icon:hover { background: #f0f2f7; }

        .submenu { overflow: hidden; max-height: 0; transition: max-height 0.4s ease-out; background-color: #fcfcfc; margin: 0 12px; border-radius: 8px; }
        .submenu.show { max-height: 500px !important; padding-bottom: 8px; border: 1px solid #eee; }
        .submenu a { padding: 10px 15px 10px 45px !important; margin: 2px 0 !important; font-size: 13px !important; }

        .icon-arrow { transition: transform 0.3s ease; display: inline-block; font-size: 10px; margin-left: auto; }
        .rotate-up { transform: rotate(180deg); }

        /* --- LAYOUT STRUCTURE FROM CODE 2 --- */
        main {
            margin-left: var(--sidebar-width-collapsed);
            transition: margin-left 0.4s;
            position: relative;
            z-index: 2;
            min-height: 100vh;
        }

        .header-banner {
            background: var(--primary-color);
            height: 220px;
            width: 100%;
            position: absolute;
            top: 0; left: 0;
            z-index: 1;
        }

        .page-wrapper {
            padding: 0 25px;
            position: relative;
            z-index: 3;
        }

        /* Nav breadcrumb text inside blue banner */
        .page-top-nav {
            height: 60px;
            display: flex;
            align-items: center;
            color: white;
            font-size: 18px;
            font-weight: 600;
            gap: 12px;
        }

        .content-card {
            background: #fff;
            border-radius: 16px 16px 0 0;
            padding: 30px;
            box-shadow: 0 -10px 25px -5px rgba(0, 0, 0, 0.1);
            min-height: calc(100vh - 120px);
            margin-top: 10px;
        }

        /* Navbar Styling */
        nav { background: transparent !important; border-bottom: none !important; box-shadow: none !important; }
        nav .text-gray-500, nav .text-gray-700 { color: rgba(255,255,255,0.9) !important; }
        nav .bg-white { background: transparent !important; }
    </style>
</head>
<body>

    <div class="sidebar-collapsed">
        <div onclick="toggleSidebar()" style="cursor:pointer; font-size:24px; margin-bottom:25px; color: var(--primary-color);">☰</div>
        <a href="{{ route('dashboard') }}" class="mini-icon {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">🏠</a>
        <a href="{{ route('assets.index') }}" class="mini-icon {{ request()->routeIs('assets.*') ? 'active' : '' }}" title="Master Data">📦</a>
        <a href="{{ route('laporan.barang') }}" class="mini-icon {{ request()->routeIs('laporan.*') ? 'active' : '' }}" title="Laporan">📋</a>
        <a href="{{ route('users.index') }}" class="mini-icon {{ request()->routeIs('users.*') ? 'active' : '' }}" title="User">👤</a>
    </div>

    <div id="sidebar" class="sidebar">
        <div style="background: var(--primary-color); padding: 30px 20px; color: #fff; position: relative;">
            <h4 style="margin:0; font-weight: 700; letter-spacing: 1px;">ASET NEGARA</h4>
            <span style="position:absolute; top:15px; right:20px; cursor:pointer; font-size:28px;" onclick="toggleSidebar()">☰</span>
        </div>

        <div class="menu-header">MAIN MENU</div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <div class="icon-placeholder">🏠</div> Dashboard
        </a>

        <div class="menu-header">MASTER DATA</div>
        <a href="javascript:void(0)" onclick="toggleSubmenu(event, 'sub-master')" class="{{ request()->routeIs('assets.*') ? 'active' : '' }}">
            <div class="icon-placeholder">📦</div>
            <span style="flex-grow: 1;">Barang</span>
            <span id="arrow-master" class="icon-arrow {{ request()->routeIs('assets.*') ? 'rotate-up' : '' }}">▼</span>
        </a>
        <div id="sub-master" class="submenu {{ request()->routeIs('assets.*') ? 'show' : '' }}">
            <a href="{{ route('assets.index') }}" style="{{ request()->routeIs('assets.index') ? 'color: var(--primary-color); font-weight: bold;' : '' }}"> • Data Barang</a>
            <a href="{{ route('assets.active') }}" style="{{ request()->routeIs('assets.active') ? 'color: var(--primary-color); font-weight: bold;' : '' }}"> • Data Barang Aktif</a>
            <a href="{{ route('assets.inactive') }}" style="{{ request()->routeIs('assets.inactive') ? 'color: var(--primary-color); font-weight: bold;' : '' }}"> • Data Barang Tidak Aktif</a>
        </div>

        <div class="menu-header">LAPORAN</div>
        <a href="{{ route('laporan.barang') }}" class="{{ request()->routeIs('laporan.barang') ? 'active' : '' }}">
            <div class="icon-placeholder">📋</div> Laporan Barang
        </a>
        <a href="{{ route('laporan.aktif') }}" class="{{ request()->routeIs('laporan.aktif') ? 'active' : '' }}">
            <div class="icon-placeholder">🟢</div> Aset Aktif
        </a>
        <a href="{{ route('laporan.nonaktif') }}" class="{{ request()->routeIs('laporan.nonaktif') ? 'active' : '' }}">
            <div class="icon-placeholder">🔴</div> Aset Tidak Aktif
        </a>

        <div class="menu-header">SISTEM</div>
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
            <div class="icon-placeholder">👤</div> Manajemen User
        </a>
    </div>

    <main id="main-content">
        <div class="header-banner"></div>

        <div class="page-wrapper">
            @unless($hideNavbar)
                @livewire('layout.navigation')
            @endunless

            <div class="page-top-nav">
                @if(request()->routeIs('dashboard'))
                    🏠 Dashboard
                @else
                    📦 Data Inventaris Barang
                @endif
            </div>

            <div class="content-card">
                {{ $slot }}
            </div>
        </div>
    </main>

    @livewireScripts
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const main = document.getElementById("main-content");
            sidebar.classList.toggle("open");
            // Adjusted to match Code 1's widths
            main.style.marginLeft = sidebar.classList.contains("open") ? "260px" : "70px";
        }

        function toggleSubmenu(e, id) {
            e.preventDefault();
            const submenu = document.getElementById(id);
            const arrow = document.getElementById('arrow-master');
            submenu.classList.toggle('show');
            arrow.classList.toggle('rotate-up');
        }
    </script>
</body>
</html>
