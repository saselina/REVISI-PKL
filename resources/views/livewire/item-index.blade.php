<div style="background-color: #ffffff; min-height: 100vh; font-family: 'Inter', sans-serif;">

    <style>
        /* ------------------------------------------- */
        /* ====== 0. VARIABEL & BASE STYLE ====== */
        /* ------------------------------------------- */
        :root {
            --sidebar-width-collapsed: 70px;
            --sidebar-width-open: 260px;
            --primary-color: #647FBC;
            --secondary-color: #91ADC8;
            --background-light: #ffffff;
            --text-color: #333;

            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        body { margin: 0; padding: 0; background-color: var(--background-light); }
        h4, p { margin: 0; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-stat {
            text-decoration: none;
            color: inherit;
            flex: 1;
            min-width: 150px;
            background: #ffffff;
            padding: 18px;
            border: 1px solid #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-stat:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
            border-color: #e2e8f0;
        }

        .custom-select-wrapper {
            position: relative;
            display: inline-block;
        }

        .select-input {
            appearance: none;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 6px 32px 6px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            outline: none;
            cursor: pointer;
            min-width: 80px;
        }

        .select-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #64748b;
            display: flex;
            align-items: center;
        }
    </style>

    <div id="main-content" style="padding: 25px;">

        @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; padding: 15px; border-radius: 8px; margin-bottom: 8px; border-left: 4px solid #15803d; animation: fadeIn 0.4s ease;">
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
        @endif

        <div style="margin-bottom: 25px; padding-top: 1px;">
            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <a href="{{ route('assets.index') }}" class="card-stat" style="animation: fadeIn .4s ease;">
                    <div style="width:48px; height:48px; background:#f0f4ff; border-radius:12px; display:flex; justify-content:center; align-items:center;">
                        <span style="font-size:24px;">📦</span>
                    </div>
                    <div>
                        <p style="color:#64748b; font-size:12px; font-weight: 700; letter-spacing: 0.5px;">DATA BARANG</p>
                        <h2 style="font-size:24px; font-weight:800; color:#1e293b; margin-top:2px;">{{ $countBarang }}</h2>
                    </div>
                </a>

                <a href="{{ route('assets.active') }}" class="card-stat" style="animation: fadeIn .5s ease;">
                    <div style="width:48px; height:48px; background:#f0fdf4; border-radius:12px; display:flex; justify-content:center; align-items:center;">
                        <span style="font-size:24px;">✅</span>
                    </div>
                    <div>
                        <p style="color:#64748b; font-size:12px; font-weight: 700; letter-spacing: 0.5px;">ASET AKTIF</p>
                        <h2 style="font-size:24px; font-weight:800; color:#10b981; margin-top:2px;">{{ $asetAktif }}</h2>
                    </div>
                </a>

                <a href="{{ route('assets.inactive') }}" class="card-stat" style="animation: fadeIn .6s ease;">
                    <div style="width:48px; height:48px; background:#fff1f2; border-radius:12px; display:flex; justify-content:center; align-items:center;">
                        <span style="font-size:24px;">⚠️</span>
                    </div>
                    <div>
                        <p style="color:#64748b; font-size:12px; font-weight: 700; letter-spacing: 0.5px;">TIDAK AKTIF</p>
                        <h2 style="font-size:24px; font-weight:800; color:#e11d48; margin-top:2px;">{{ $asetTidakAktif }}</h2>
                    </div>
                </a>

                <div class="card-stat" style="background: var(--primary-color); border: none; animation: fadeIn .7s ease;">
                    <div style="width:48px; height:48px; background: rgba(255, 255, 255, 0.2); border-radius:12px; display:flex; justify-content:center; align-items:center;">
                        <span style="font-size:24px; color: white;">👥</span>
                    </div>
                    <div>
                        <p style="color:rgba(255, 255, 255, 0.8); font-size:12px; font-weight: 700; letter-spacing: 0.5px;">DATA USER</p>
                        <h2 style="font-size:24px; font-weight:800; color:#ffffff; margin-top:2px;">{{ $totalUser }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 15px;">
            <div>
                <h4 style="color: #334155; font-weight: 700; font-size: 16px;">Log Inventaris Terbaru</h4>
                <p style="color: #94a3b8; font-size: 12px;">Menampilkan ringkasan aset terakhir yang tercatat.</p>
            </div>

            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 13px; color: #64748b; font-weight: 500;">Tampilkan</span>
                <div class="custom-select-wrapper">
                    <select wire:model.live="perPage" class="select-input">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto; background-color: white; border-radius: 6px; border: 1px solid #eef2f6; box-shadow: var(--card-shadow);">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: var(--secondary-color); color: white;">
                        <th style="padding: 15px 20px; width: 60px; text-align: center; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">NO</th>
                        <th style="padding: 15px 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Informasi Barang</th>
                        <th style="padding: 15px 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Kategori</th>
                        <th style="padding: 15px 20px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Lokasi & Detail</th>
                        <th style="padding: 15px 20px; text-align: center; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assets as $item)
                        <tr style="border-bottom: 1px solid #f8fafc; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 15px 20px; text-align: center; color: #94a3b8; font-size: 13px; font-weight: 600;">{{ $loop->iteration }}</td>
                            <td style="padding: 15px 20px;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 14px; text-transform: uppercase;">
                                    {{ $item->nama_barang }}
                                </div>
                                <div style="font-size: 11px; color: #64748b; margin-top: 2px;">Manufacture: {{ $item->manufacture }}</div>
                            </td>
                            <td style="padding: 15px 20px;">
                                <span style="background: #f0f7ff; color: #647FBC; padding: 5px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; text-transform: uppercase; border: 1px solid #dbeafe;">
                                    {{ $item->kategori ?? $item->category }}
                                </span>
                            </td>

                            <td style="padding: 15px 20px; vertical-align: middle;">
                                <div style="display: flex; flex-direction: column; justify-content: center; min-height: 40px;">
                                    <div style="font-weight: 700; color: #334155; font-size: 13px;">
                                        {{ $item->gedung }}
                                    </div>
                                    @if(!empty($item->lokasi))
                                        <div style="font-size: 11px; color: #94a3b8; display: flex; align-items: center; gap: 4px; margin-top: 2px;">
                                            <span style="color: #647FBC;">📍</span> {{ $item->lokasi }}
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td style="padding: 15px 20px; text-align: center;">
                                @php
                                    $status = strtolower($item->status);
                                    $isHijau = str_contains($status, 'aktif') || str_contains($status, 'active') || str_contains($status, 'baik');
                                    $isMerah = str_contains($status, 'tidak') || str_contains($status, 'rusak') || str_contains($status, 'kusam') || str_contains($status, 'hilang');
                                    if(str_contains($status, 'tidak')) { $isHijau = false; $isMerah = true; }
                                @endphp

                                <div style="background-color: {{ $isHijau ? '#ecfdf5' : ($isMerah ? '#fff1f2' : '#f8fafc') }};
                                            color: {{ $isHijau ? '#059669' : ($isMerah ? '#e11d48' : '#64748b') }};
                                            border: 1px solid {{ $isHijau ? '#d1fae5' : ($isMerah ? '#ffe4e6' : '#e2e8f0') }};
                                            padding: 6px 0; border-radius: 8px; font-size: 10px; font-weight: 800; text-transform: uppercase; width: 100px; margin: 0 auto;">
                                    {{ $item->status }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 60px; text-align: center; color: #94a3b8;">
                                <span style="font-size: 40px; display: block; margin-bottom: 10px;">🍃</span>
                                <p style="font-size: 14px; font-style: italic;">Belum ada data barang terbaru untuk ditampilkan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($assets->hasPages())
        <div style="margin-top: 20px;">
            {{ $assets->links() }}
        </div>
        @endif
    </div>
</div>
