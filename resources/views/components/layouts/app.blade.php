@props(['title' => '', 'hideNavbar' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?: 'Sistem Aset' }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        :root {
            --sidebar-width-collapsed: 75px;
            --sidebar-width-open: 260px;
            --primary-color: #5C61D6;
            --primary-dark: #4A4EB8;
            --accent-gold: linear-gradient(135deg, #FFD60A 0%, #F59E0B 100%);
            --background-light: #f8f9fa;
            --transition-main: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            margin: 0;
            background-color: var(--background-light);
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
        }

        /* --- LOGO BARU (SHIELD HEXAGON) --- */
        .logo-shield {
            background: var(--accent-gold);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            /* Membuat bentuk perisai/hexagon */
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
        }

        .mini-logo-box {
            width: 36px;
            height: 40px;
            font-size: 18px;
        }

        .logo-mark {
            width: 42px;
            height: 48px;
            font-size: 22px;
            flex-shrink: 0;
        }

        /* --- SIDEBAR MINI (COLLAPSED) --- */
        .sidebar-collapsed {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width-collapsed);
            height: 100vh;
            background: #fff;
            box-shadow: 2px 0 15px rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 1200;
            border-right: 1px solid #f1f1f1;
        }

        .mini-header {
            width: 100%;
            height: 88px;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
        }

        .mini-icon {
            width: 48px; height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #888;
            margin-bottom: 12px;
            border-radius: 12px;
            transition: all 0.3s;
            position: relative;
            text-decoration: none;
        }

        .mini-icon:hover {
            background: #f3f4f6;
            color: var(--primary-color);
        }

        .mini-icon.active {
            background: rgba(92, 97, 214, 0.1);
            color: var(--primary-color);
        }

        .mini-icon.active::before {
            content: "";
            position: absolute;
            left: -13px;
            width: 4px;
            height: 24px;
            background: var(--primary-color);
            border-radius: 0 4px 4px 0;
        }

        .mini-footer {
            margin-top: auto;
            margin-bottom: 25px;
            padding-top: 15px;
            border-top: 1px solid #f1f1f1;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .mini-avatar {
            width: 38px; height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color), #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 16px;
        }

        /* --- SIDEBAR FULL --- */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1300;
            top: 0; left: 0;
            background: #fff;
            overflow-x: hidden;
            transition: width var(--transition-main);
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            white-space: nowrap;
        }

        .sidebar.open { width: var(--sidebar-width-open); }
        .sidebar > * { opacity: 0; transition: opacity 0.2s; }
        .sidebar.open > * { opacity: 1; transition: opacity 0.3s ease 0.1s; }

        .logo-container {
            background: var(--primary-color);
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            height: 88px;
            box-sizing: border-box;
        }

        .logo-text {
            color: #fff;
            font-weight: 800;
            font-size: 19px;
            line-height: 1.1;
        }

        .logo-text span {
            font-size: 10px;
            font-weight: 500;
            opacity: 0.8;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .user-section {
            padding: 22px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #f1f1f1;
            margin-bottom: 5px;
        }

        .user-avatar {
            width: 44px; height: 44px;
            border-radius: 12px;
            background: #EEF2FF;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
            border: 1px solid rgba(92, 97, 214, 0.1);
        }

        .user-info h5 { margin: 0; font-size: 13px; font-weight: 700; color: #1F2937; }
        .user-info p { margin: 0; font-size: 10px; color: #9CA3AF; font-weight: 600; text-transform: uppercase; }

        .menu-header {
            padding: 25px 25px 10px;
            font-size: 11px;
            font-weight: 800;
            color: #b0b0b0;
            letter-spacing: 1.2px;
            text-transform: uppercase;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 18px;
            margin: 4px 15px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar a:hover { background: #f8f9fa; color: var(--primary-color); }
        .sidebar a.active {
            background: var(--primary-color) !important;
            color: #fff !important;
            box-shadow: 0 4px 12px rgba(92, 97, 214, 0.25);
        }

        .icon-placeholder { width: 24px; margin-right: 12px; text-align: center; font-size: 18px; }

        .submenu {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
            margin: 0 15px;
        }
        .submenu.show { max-height: 200px; }
        .submenu a { padding-left: 45px; font-size: 13px; }

        main {
            margin-left: var(--sidebar-width-collapsed);
            transition: margin-left var(--transition-main);
            min-height: 100vh;
        }

        .header-banner {
            background: var(--primary-color);
            height: 180px; width: 100%;
            position: absolute; top: 0; z-index: 1;
        }

        .content-card {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            position: relative; z-index: 5;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<!-- Area deteksi hover -->
<div style="position:fixed; top:0; left:0; width:15px; height:100vh; z-index:1400;" onmouseenter="handleHover(true)"></div>

<!-- Sidebar Collapsed (Mini) -->
<div class="sidebar-collapsed" onmouseenter="handleHover(true)">
    <div class="mini-header">
        <!-- LOGO BARU DI MINI SIDEBAR -->
        <div class="logo-shield mini-logo-box">
            G
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="mini-icon {{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
        <i class="fa-solid fa-house"></i>
    </a>
    <a href="{{ route('assets.index') }}" class="mini-icon {{ request()->routeIs('assets.*') ? 'active' : '' }}" title="Data Barang">
        <i class="fa-solid fa-box-archive"></i>
    </a>
    <a href="{{ route('laporan.barang') }}" class="mini-icon {{ request()->routeIs('laporan.barang') ? 'active' : '' }}" title="Laporan Stok">
        <i class="fa-solid fa-chart-line"></i>
    </a>
    <a href="{{ route('users.index') }}" class="mini-icon {{ request()->routeIs('users.*') ? 'active' : '' }}" title="Manajemen User">
        <i class="fa-solid fa-user-gear"></i>
    </a>

    <div class="mini-footer">
        <div class="mini-avatar">
            <i class="fa-solid fa-user"></i>
        </div>
    </div>
</div>

<!-- Sidebar Full (Open) -->
<div id="sidebar" class="sidebar" onmouseleave="handleHover(false)">
    <div class="logo-container">
        <!-- LOGO BARU DI SIDEBAR TERBUKA -->
        <div class="logo-shield logo-mark">
            G
        </div>
        <div class="logo-text">
            GudangAset
            <span>System Management</span>
        </div>
        <i class="fa-solid fa-bars-staggered" onclick="toggleSidebar()" style="margin-left:auto; color:#fff; cursor:pointer; opacity:0.8;"></i>
    </div>

    <div class="user-section">
        <div class="user-avatar">
            {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
        </div>
        <div class="user-info">
            <h5>{{ auth()->user()->username }}</h5>
            <p>{{ auth()->user()->role }}</p>
        </div>
    </div>

    <div class="menu-header">MAIN MENU</div>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <div class="icon-placeholder"><i class="fa-solid fa-house"></i></div> Dashboard
    </a>

    <div class="menu-header">MASTER</div>
    <a href="javascript:void(0)" onclick="toggleSubmenu(event,'sub-master')" class="{{ request()->routeIs('assets.*') ? 'active' : '' }}">
        <div class="icon-placeholder"><i class="fa-solid fa-box-archive"></i></div>
        <span style="flex-grow:1;">Barang</span>
        <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
    </a>
    <div id="sub-master" class="submenu {{ request()->routeIs('assets.*') ? 'show' : '' }}">
        <a href="{{ route('assets.index') }}" class="{{ request()->routeIs('assets.index') ? 'active' : '' }}">Data Barang</a>
        <a href="#">Aset Aktif</a>
        <a href="#">Aset Tidak Aktif</a>
    </div>

    <div class="menu-header">LAPORAN</div>
    <a href="{{ route('laporan.barang') }}" class="{{ request()->routeIs('laporan.barang') ? 'active' : '' }}">
        <div class="icon-placeholder"><i class="fa-solid fa-chart-line"></i></div> Laporan Stok
    </a>

    <div class="menu-header">SISTEM</div>
    <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
        <div class="icon-placeholder"><i class="fa-solid fa-user-gear"></i></div> Manajemen User
    </a>
</div>

<main id="main-content">
    <div class="header-banner"></div>
    <div style="padding: 0 30px; position: relative; z-index: 10;">
        <div style="height: 88px; display: flex; align-items: center; justify-content: space-between; color: #fff;">
            <div style="font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">{{ $title ?? 'Dashboard' }}</div>
            @unless($hideNavbar)
                <!-- Tambahkan menu navigasi jika diperlukan -->
            @endunless
        </div>

        <div class="content-card">
            {{ $slot }}
        </div>
    </div>
</main>

@livewireScripts
<script>
    let isPinned = false;

    function updateLayout(isOpen) {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main-content');
        if (isOpen) {
            sidebar.classList.add('open');
            main.style.marginLeft = '260px';
        } else {
            sidebar.classList.remove('open');
            main.style.marginLeft = '75px';
        }
    }

    function toggleSidebar() {
        isPinned = !isPinned;
        updateLayout(isPinned);
    }

    function handleHover(open) {
        if (!isPinned) updateLayout(open);
    }

    function toggleSubmenu(e, id) {
        e.preventDefault();
        document.getElementById(id).classList.toggle('show');
    }
</script>
</body>
</html>
