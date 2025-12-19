<div style="background-color: #f7f7f7; min-height: 100vh;">
    <style>
        /* ------------------------------------------- */
        /* ====== 0. VARIABEL & BASE STYLE ====== */
        /* ------------------------------------------- */
        :root {
            --sidebar-width-collapsed: 70px;
            --sidebar-width-open: 260px;
            --primary-color: #647FBC; /* Biru Utama */
            --secondary-color: #91ADC8; /* Biru Sekunder/Tabel Header */
            --background-light: #f7f7f7;
            --background-card: #F9F8F6;
            --text-color: #333;
        }

        /* Styling Umum */
        body { margin: 0; padding: 0; background-color: var(--background-light); }
        h4, p { margin: 0; }
        .flex-row-wrap { display: flex; flex-wrap: wrap; gap: 15px; }

        /* ------------------------------------------- */
        /* ====== 1. SIDEBAR TERTUTUP (COLLAPSED) ====== */
        /* ------------------------------------------- */
        .sidebar-collapsed {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width-collapsed);
            height: 100vh;
            background: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 900;
        }

        /* [CSS dari skrip Anda di sini, tidak diulang untuk brevity] */
        .sidebar-collapsed .dot-icon {
            font-size: 28px;
            background: #647FBC;
            color: #fff;
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 25px;
            cursor: pointer;
        }

        .sidebar-collapsed .avatar-placeholder {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin-bottom: 25px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #647FBC;
        }

        .sidebar-collapsed .mini-icon {
            width: 46px;
            height: 46px;
            margin: 12px 0;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            transition: .25s;
            cursor: pointer;
        }

        .sidebar-collapsed .mini-icon .icon {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .sidebar-collapsed .mini-icon.active {
            background: #647FBC;
            box-shadow: 0 4px 12px rgba(100, 127, 188, .4);
        }

        .sidebar-collapsed .mini-icon.active .icon {
            color: #fff;
        }

        .sidebar-collapsed .mini-icon:hover {
            background: #e6e6e6;
        }

        /* ------------------------------------------- */
        /* ====== 2. SIDEBAR TERBUKA (OVERLAY) ====== */
        /* ------------------------------------------- */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            background: #fff;
            overflow-x: hidden;
            transition: width .4s; /* Ganti dari .4s ke width .4s untuk spesifik */
            box-shadow: 2px 0 10px rgba(0,0,0,.1);
        }

        .sidebar.open {
            width: var(--sidebar-width-open);
        }

        .sidebar-profile {
            background: var(--primary-color);
            padding: 30px 20px 25px;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
            position: relative;
        }

        .sidebar-profile .avatar-placeholder-lg {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            border: 3px solid #fff;
            margin-bottom: 10px;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .sidebar-profile h4, .sidebar-profile p {
            margin: 0;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 18px;
            right: 18px;
            font-size: 30px;
            cursor: pointer;
            color: #fff;
            border-radius: 50%;
            padding: 4px 10px;
            line-height: 1;
        }

        .sidebar .menu-header {
            padding: 10px 20px 5px;
            font-size: 12px;
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            margin: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-color);
            text-decoration: none;
            transition: .25s;
        }

        .sidebar a .icon-placeholder {
            width: 26px;
            height: 26px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            background: #e9ecf4;
            color: var(--primary-color);
            font-size: 16px;
            transition: .25s;
        }

        .sidebar a:hover, .sidebar a.active {
            background: var(--primary-color);
            color: #fff;
        }
        .sidebar a:hover .icon-placeholder,
        .sidebar a.active .icon-placeholder {
            background: rgba(255,255,255,.25);
            color: #fff;
        }

        /* ------------------------------------------- */
        /* ====== 2.1. SIDEBAR DROPDOWN (MASTER) ====== */
        /* ------------------------------------------- */
        .sidebar .dropdown-toggle {
            cursor: pointer;
            position: relative;
            display: flex; /* WAJIB: Agar konten dan panah bisa diatur */
            align-items: center;
        }

        .sidebar .dropdown-toggle .arrow {
            margin-left: auto;
            transition: transform 0.3s;
            font-size: 10px;
        }

        .sidebar .dropdown-toggle.open .arrow {
            transform: rotate(180deg);
        }

        /* Container Submenu */
        .sidebar .submenu {
            /* display: none; Akan di-toggle oleh JS */
            overflow: hidden;
            padding: 0 0 0 40px; /* Indentasi sub-menu */
            max-height: 0; /* Untuk animasi slide up/down */
            transition: max-height 0.4s ease-in-out;
        }

        /* Submenu Item */
            padding: 8px 0;
            margin: 4px 0;
            font-size: 13px;
            color: #555;
            background: transparent;
        }

        .sidebar .submenu a:hover {
            color: var(--primary-color);
            background: transparent;
        }

        .sidebar a.has-submenu {
            /* Style khusus untuk item menu yang memiliki dropdown */
            background: #f8f9fa;
            color: var(--text-color);
        }

        .sidebar a.has-submenu:hover {
            background: #e9ecef;
        }

        /* Style untuk Animasi Card */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

        <div id="main-content" style="padding: 20px;">
            <div style="background-color: #F9F8F6; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #eee; margin-bottom: 25px;">
                <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <a href="{{ route('assets.index') }}"
   style="text-decoration: none; color: inherit; flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
   onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">

                        <div style="width:40px; height:40px; background:#e9ecf4; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#647FBC;">📦</span>
                        </div>

                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Data Barang</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">{{ $countBarang }}</h2>
                        </div>
                    </a>

                    <a href="{{ route('assets.active') }}"
   style="text-decoration: none; color: inherit; flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
   onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">

                        <div style="width:40px; height:40px; background:#ecfdf5; border: 1px solid #e5e7eb; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#10b981;">⬇️</span>
                        </div>

                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Aset Aktif</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">{{ $asetAktif }}</h2>
                        </div>

                    </a>
                      <a href="{{ route('assets.inactive') }}"

   style="text-decoration: none; color: inherit; flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
   onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">

                        <div style="width:40px; height:40px; background:#fff7ed; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#f97316;">⬆️</span>
                        </div>

                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Aset Tidak Aktif</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">{{ $asetTidakAktif }}</h2>
                        </div>

                        </a>

                        <div style="flex: 1; min-width:120px; background:#97afe7; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">



                        <div style="width:40px; height:40px; background:#fdf2f8; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#ec4899;">👥</span>
                        </div>

                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Data User</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">{{ $totalUser }}</h2>

                        </div>
                    </div>
                </div>
            </div>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding: 0 5px;">

    <div style="display: flex; align-items: center; gap: 10px; font-family: 'Inter', sans-serif;">
    <span style="font-size: 14px; color: #666; font-weight: 500;">Tampilkan</span>
    <div style="position: relative; display: flex; align-items: center;">
        <select wire:model.live="perPage"
            style="
                appearance: none;
                -webkit-appearance: none;
                background: white;
                border: 1px solid #333; /* Border lebih gelap agar sudut tajam terlihat jelas */
                border-radius: 0; /* Membuat sudut menjadi tajam/kotak */
                padding: 6px 35px 6px 12px;
                font-size: 14px;
                font-weight: 600;
                cursor: pointer;
                outline: none;
                color: #333;
            "
        >
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
        </select>

        <div style="position: absolute; right: 10px; pointer-events: none; color: #333; display: flex;">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="square" stroke-linejoin="miter">
                <path d="M6 9l6 6 6-6"/>
            </svg>
        </div>
    </div>
    <span style="font-size: 14px; color: #666; font-weight: 500;">data</span>
</div>
</div>

<div style="overflow-x: auto; background-color: #F9F8F6; border-radius: 12px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.05);" wire:transition>
    <table style="width: 100%; border-collapse: collapse; text-align: left; table-layout: fixed;">
        <thead>
            <tr style="background-color: #91ADC8; color: #F9F8F6;">
                <th style="padding: 15px; width: 60px; text-align: center; font-size: 13px;">NO <span style="font-size: 10px; opacity: 0.7;">⇅</span></th>
                <th style="padding: 15px; width: 35%; font-size: 13px;">NAMA BARANG <span style="font-size: 10px; opacity: 0.7;">⇅</span></th>
                <th style="padding: 15px; width: 20%; font-size: 13px;">KATEGORI <span style="font-size: 10px; opacity: 0.7;">⇅</span></th>
                <th style="padding: 15px; width: 25%; font-size: 13px;">LOKASI <span style="font-size: 10px; opacity: 0.7;">⇅</span></th>
                <th style="padding: 15px; width: 15%; text-align: center; font-size: 13px;">STATUS <span style="font-size: 10px; opacity: 0.7;">⇅</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($assets as $item)
                <tr wire:key="item-{{ $item->id }}" style="border-bottom: 1px solid #eee; background: white; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='white'">
                    <td style="padding: 15px; text-align: center; color: #888; font-size: 13px;">{{ $loop->iteration }}</td>

                    <td style="padding: 15px;">
                        <div style="font-weight: 700; color: #334155; font-size: 14px; text-transform: uppercase;">
                            {{ $item->nama_barang }} {{ $item->manufacture }}
                        </div>
                    </td>

                    <td style="padding: 15px;">
                        <span style="background: #eff6ff; color: #647FBC; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px;">
                            {{ $item->kategori ?? $item->category }}
                        </span>
                    </td>

                    <td style="padding: 15px;">
                        <div style="font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase;">{{ $item->gedung }}</div>
                        <div style="font-size: 11px; color: #94a3b8; font-weight: 500;">R. {{ $item->ruangan }}</div>
                    </td>

                    <td style="padding: 15px; text-align: center;">
                        @php
                            $status = strtolower($item->status);
                            $isAktif = str_contains($status, 'aktif') || str_contains($status, 'active');
                        @endphp
                        <span style="
                            padding: 5px 14px;
                            border-radius: 20px;
                            font-size: 10px;
                            font-weight: 800;
                            text-transform: uppercase;
                            background-color: {{ $isAktif ? '#dcfce7' : '#fee2e2' }};
                            color: {{ $isAktif ? '#15803d' : '#b91c1c' }};
                            display: inline-block;
                            min-width: 80px;
                        ">
                            {{ $item->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8; font-style: italic; font-size: 14px;">
                        Belum ada data barang terbaru.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
