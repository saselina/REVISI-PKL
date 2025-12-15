<div style="background-color: #f7f7f7; min-height: 100vh;">

    <style>
        /* ------------------------------------------- */
        /* ====== 1. SIDEBAR TERTUTUP (COLLAPSED) ====== */
        /* ------------------------------------------- */

        .sidebar-collapsed {
            position: fixed;
            top: 0;
            left: 0;
            width: 70px;
            height: 100vh;
            background: #fff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 900;
        }

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
            transition: .4s;
            box-shadow: 2px 0 10px rgba(0,0,0,.1);
        }

        .sidebar.open {
            width: 260px;
        }

        .sidebar-profile {
            background: #647FBC;
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
            color: #647FBC;
        }

        .sidebar-profile h4, .sidebar-profile p {
            margin: 0;
        }

        .sidebar-profile h4 {
            font-size: 16px;
        }
        .sidebar-profile p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.8);
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
        .sidebar .closebtn:hover {
            background: rgba(255, 255, 255, 0.2);
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
            color: #333;
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
            color: #647FBC;
            font-size: 16px;
            transition: .25s;
        }

        .sidebar a:hover, .sidebar a.active {
            background: #647FBC;
            color: #fff;
        }

        .sidebar a:hover .icon-placeholder,
        .sidebar a.active .icon-placeholder {
            background: rgba(255,255,255,.25);
            color: #fff;
        }
        /* Style untuk Animasi Card */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div style="padding-left: 70px;">
        <div class="sidebar-collapsed">
            <div class="dot-icon" onclick="openSidebar()">⋮</div>

            <div class="avatar-placeholder">U</div>

            <div class="mini-icon active" title="Dashboard">
                <div class="icon">🏠</div>
            </div>
            <div class="mini-icon" title="Kategori">
                <div class="icon">📁</div>
            </div>
            <div class="mini-icon" title="Riwayat">
                <div class="icon">📄</div>
            </div>
            <div class="mini-icon" title="Status Aset">
                <div class="icon">🔄</div>
            </div>
            <div class="mini-icon" title="Laporan">
                <div class="icon">📊</div>
            </div>
            <div class="mini-icon" title="Pengaturan">
                <div class="icon">⚙️</div>
            </div>
            <div class="mini-icon" title="Logout">
                <div class="icon">🚪</div>
            </div>
        </div>

        <div id="sidebar" class="sidebar">
            <div class="sidebar-profile">
                <div class="avatar-placeholder-lg">U</div>
                <h4>User Name</h4>
                <p>Administrator</p>
                <span class="closebtn" onclick="closeSidebar()">×</span>
            </div>

            <div class="menu-header">Main Menu</div>
            <a href="#" class="active">
                <div class="icon-placeholder">🏠</div> Dashboard
            </a>

            <a href="#">
                <div class="icon-placeholder">📁</div> Kategori
            </a>

            <div class="menu-header">Management</div>
            <a href="#">
                <div class="icon-placeholder">📄</div> Riwayat
            </a>

            <a href="#">
                <div class="icon-placeholder">🔄</div> Status Aset
            </a>

            <div class="menu-header">Laporan</div>
            <a href="#">
                <div class="icon-placeholder">📊</div> Laporan
            </a>
        </div>

        <div id="main-content" style="padding: 20px;">
            <div style="background-color: #F9F8F6; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #eee; margin-bottom: 25px;">

                <div style="display: flex; flex-wrap: wrap; gap: 10px;">

                    <div style="flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 2px 6px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                        <div style="width:40px; height:40px; background:#e9ecf4; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#647FBC;">📦</span>
                        </div>
                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Data Barang</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">13</h2>
                        </div>
                    </div>

                    <div style="flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                        <div style="width:40px; height:40px; background:#ecfdf5; border: 1px solid #e5e7eb; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#10b981;">⬇️</span>
                        </div>
                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Aset Aktif</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">0</h2>
                        </div>
                    </div>

                    <div style="flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                        <div style="width:40px; height:40px; background:#fff7ed; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#f97316;">⬆️</span>
                        </div>
                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Aset Tidak Aktif</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">5</h2>
                        </div>
                    </div>

                    <div style="flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                        <div style="width:40px; height:40px; background:#fffbeb; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#facc15;">🗂️</span>
                        </div>
                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Data Kategori</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">5</h2>
                        </div>
                    </div>

                    <div style="flex: 1; min-width:120px; background:#F9F8F6; padding:12px; border: 1px solid #e5e7eb; border-radius:8px; display:flex; align-items:center; gap:10px; box-shadow:0 1px 3px rgba(0,0,0,0.05); transition: transform .2s ease, box-shadow .2s ease; animation: fadeIn .4s ease;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.1)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)';">
                        <div style="width:40px; height:40px; background:#fdf2f8; border-radius:50%; display:flex; justify-content:center; align-items:center;">
                            <span style="font-size:20px; color:#ec4899;">👥</span>
                        </div>
                        <div>
                            <p style="color:#6c757d; font-size:12px; margin:0;">Data User</p>
                            <h2 style="font-size:20px; font-weight:700; color:#333; margin:3px 0 0;">2</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">

                <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end; flex-grow: 1;">

                    <div style="flex-shrink: 0; min-width: 200px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555; font-size: 12px;">Pilih Gedung</label>
                        <select wire:model.live="filterGedung" id="filterGedung"
                                style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #F9F8F6; appearance: none;">
                            <option value="">-- Semua Gedung --</option>
                            @foreach($listGedung as $gedung)
                                <option value="{{ $gedung }}">{{ $gedung }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="flex-shrink: 0; min-width: 200px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555; font-size: 12px;">Pilih Kategori</label>
                        <select wire:model.live="filterKategori" id="filterKategori"
                                style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #F9F8F6; appearance: none;">
                            <option value="">-- Semua Kategori --</option>
                            <option value="Furniture">Furniture</option>
                            <option value="IT">IT</option>
                            <option value="Elektronik">Elektronik</option>
                            <option value="Vehicle / Kendaraan">Vehicle / Kendaraan</option>
                            <option value="Peralatan Kantor">Peralatan Kantor</option>
                        </select>
                    </div>

                    <div style="flex-grow: 1; max-width: 300px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555; font-size: 12px;">Cari Barang</label>
                        <input type="text" wire:model.live.debounce.300ms="search" id="search"
                                placeholder="Cari Nama/Ruangan..."
                                style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; height: 42px; background-color: #F9F8F6;">
                    </div>

                    <div style="flex-shrink: 0; margin-top: 20px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555; font-size: 12px; opacity: 0;">Tombol</label>
                        <button type="button"
                                wire:click="resetFilter"
                                style="background-color: #C8D7E6; color: #46587E; padding: 10px 18px; border: none; border-radius: 6px; text-decoration: none; font-weight: 600; cursor: pointer; height: 42px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; align-items: center;">
                            <span style="font-size: 14px; margin-right: 5px;">🔄</span> Reset Filter
                        </button>
                    </div>
                </div>

                <div style="flex-shrink: 0; margin-top: 20px;">
                    <label style="display: block; margin-bottom: 5px; font-weight: 500; color: #555; font-size: 12px; opacity: 0;">Tombol</label>
                    <a href="{{ route('assets.create') }}"
                        style="background-color: #647FBC; color: #F9F8F6; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: 600; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; align-items: center; height: 42px;">
                        <span style="font-size: 18px; line-height: 1; margin-right: 5px;">+</span> Tambah Barang
                    </a>
                </div>

            </div>

            <div style="overflow-x: auto; background-color: #F9F8F6; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); position: relative; min-height: 350px;" wire:transition>
                <table style="width: 100%; border-collapse: collapse; table-layout: fixed; text-align: center;">
                    <thead>
                        <tr style="background-color: #91ADC8; color: #F9F8F6;">
                            <th style="padding: 12px; text-align: center; width: 5%; border: 1px solid #91ADC8;">NO</th>
                            <th style="padding: 12px; text-align: center; width: 18%; border: 1px solid #91ADC8;">Gedung</th>
                            <th style="padding: 12px; text-align: center; width: 25%; border: 1px solid #91ADC8;">Nama Barang</th>
                            <th style="padding: 12px; text-align: center; width: 15%; border: 1px solid #91ADC8;">Kategori</th>
                            <th style="padding: 12px; text-align: center; width: 20%; border: 1px solid #91ADC8;">Ruangan</th>
                            <th style="padding: 12px; text-align: center; width: 15%; border: 1px solid #91ADC8;">Status</th>
                            <th style="padding: 12px; text-align: center; width: 20%; border: 1px solid #91ADC8;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assets as $item)
                            <tr wire:key="item-{{ $item->id }}">
                                <td style="border: 1px solid #DDE5EE; padding: 12px; text-align: center;">{{ $loop->iteration }}</td>
                                <td style="border: 1px solid #DDE5EE; padding: 12px;">{{ $item->gedung }}</td>
                                <td style="border: 1px solid #DDE5EE; padding: 12px;">{{ $item->nama_barang }} {{ $item->manufacture }}</td>
                                <td style="border: 1px solid #DDE5EE; padding: 12px;">{{ $item->kategori ?? $item->category }}</td>
                                <td style="border: 1px solid #DDE5EE; padding: 12px;">{{ $item->ruangan }}</td>
                                <td style="border: 1px solid #DDE5EE; padding: 12px; font-weight: 600;">
                                    <span style="color: {{ $item->status == 'Aktif' ? '#28a745' : '#dc3545' }};">{{ $item->status }}</span>
                                </td>
                                <td style="border: 1px solid #DDE5EE; padding: 12px; text-align: center; white-space: nowrap;">
                                    <a href="{{ route('assets.detail', $item->id) }}" style="display: inline-block; width: 35px; height: 35px; background-color: #91ADC8; border-radius: 50%; text-decoration: none; margin-right: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                                        <span style="line-height: 35px; font-size: 16px; color: #F9F8F6;">📄</span>
                                    </a>
                                    <a href="{{ route('assets.edit', $item->id) }}" style="display: inline-block; width: 35px; height: 35px; background-color: #647FBC; border-radius: 50%; text-decoration: none; margin-right: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                                        <span style="line-height: 35px; font-size: 16px; color: #F9F8F6;">✏️</span>
                                    </a>
                                    <button type="button" wire:click="confirmDelete({{ $item->id }})" style="display: inline-block; width: 35px; height: 35px; background-color: #86B0BD; border: none; border-radius: 50%; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                                        <span style="line-height: 35px; font-size: 16px; color: white;">🗑️</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="border: 1px solid #DDE5EE; padding: 20px; text-align: center; color: #999;">
                                    Tidak ada data aset ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div style="padding: 15px; border-top: 1px solid #eee; display: flex; align-items: center; justify-content: center; background-color: #F9F8F6;">
                    <div style="text-align: center; width: 100%;">
                        {{ $assets->links() }}
                    </div>
                </div>
            </div>
        </div>
        </div>

    <script>
        function openSidebar() {
            document.getElementById("sidebar").classList.add("open");
        }
        function closeSidebar() {
            document.getElementById("sidebar").classList.remove("open");
        }

        // Livewire Confirm Delete Hook
        document.addEventListener('livewire:init', () => {
            Livewire.on('showDeleteConfirm', () => {
                if (confirm("Yakin ingin menghapus data ini?")) {
                    Livewire.dispatch('deleteItem');
                }
            });
        });
    </script>
</div>
