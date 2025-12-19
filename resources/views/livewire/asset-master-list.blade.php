<div style="margin-left: var(--sidebar-width-collapsed); transition: margin-left .4s; padding: 20px;" id="main-layout-container">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="margin: 0; color: #333; font-weight: 700;">Data Inventaris Barang</h2>
        <a href="{{ route('assets.index') }}"
           style="background-color: #647FBC; color: #F9F8F6; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px rgba(100, 127, 188, 0.2);">
            <span>+</span> Tambah Barang
        </a>
    </div>

    <div style="background-color: #F9F8F6; padding: 20px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #eee; margin-bottom: 25px;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 15px;">

        <div style="min-width: 250px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555; font-size: 13px;">Pilih Gedung</label>
            <select wire:model.live="filterGedung"
                style="width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; outline: none; background: #fff; cursor: pointer; font-size: 14px;">
                <option value="">Semua Gedung </option>
                @foreach($listGedung as $gedung)
                    <option value="{{ $gedung }}">{{ $gedung }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; align-items: flex-end; gap: 12px; min-width: 350px;">
            <div style="flex-grow: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #555; font-size: 13px;">Cari Barang</label>
                <div style="position: relative;">
                    <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #999;">🔍</span>
                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Nama, manufacture, atau ruangan..."
                        style="width: 100%; padding: 10px 10px 10px 35px; border: 1px solid #ddd; border-radius: 8px; outline: none; font-size: 14px;">
                </div>
            </div>

            <button type="button" wire:click="resetFilter"
                style="background-color: #f1f5f9; color: #475569; padding: 10px 18px; border: 1px solid #cbd5e1; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer; transition: 0.2s; white-space: nowrap;"
                onmouseover="this.style.backgroundColor='#e2e8f0'"
                onmouseout="this.style.backgroundColor='#f1f5f9'">
                🔄 Reset
            </button>
        </div>

    </div>
</div>

    <div style="background-color: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #91ADC8; color: white; text-align: left;">
                    <th style="padding: 15px; width: 50px; text-align: center;">NO</th>
                    <th style="padding: 15px;">NAMA BARANG</th>
                    <th style="padding: 15px;">LOKASI / RUANGAN</th>
                    <th style="padding: 15px; text-align: center;">STATUS</th>
                    <th style="padding: 15px; text-align: center;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assets as $item)
                <tr style="border-bottom: 1px solid #f0f0f0; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 15px; text-align: center; color: #888;">{{ $loop->iteration }}</td>
                    <td style="padding: 15px;">
                        <div style="font-weight: 700; color: #333;">{{ $item->nama_barang }} {{ $item->manufacture }}</div>
                        <div style="font-size: 11px; color background: #eef2ff; display: inline-block; padding: 2px 6px; border-radius: 4px; margin-top: 4px;">
                            {{ $item->kategori }}
                        </div>
                    </td>
                    <td style="padding: 15px;">
                        <div style="font-weight: 500; color: #444;">{{ $item->gedung }}</div>
                        <div style="font-size: 12px; color: #888;">{{ $item->ruangan }}</div>
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        @if($item->status == 'Aktif')
                            <span style="background: #dcfce7; color: #15803d; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;">Aktif</span>
                        @else
                            <span style="background: #fee2e2; color: #b91c1c; padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600;">Non-Aktif</span>
                        @endif
                    </td>
                    <td style="padding: 15px; text-align: center; white-space: nowrap;">
                        <a href="{{ route('assets.detail', $item->id) }}" style="text-decoration:none; padding: 8px; background: #f1f5f9; border-radius: 6px; margin: 0 2px;">📄</a>
                        <a href="{{ route('assets.edit', $item->id) }}" style="text-decoration:none; padding: 8px; background: #f1f5f9; border-radius: 6px; margin: 0 2px;">✏️</a>
                        <button wire:click="confirmDelete({{ $item->id }})" style="border:none; cursor:pointer; padding: 8px; background: #fee2e2; border-radius: 6px; margin: 0 2px;">🗑️</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 50px; text-align: center; color: #999;">Data tidak ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div style="padding: 20px; border-top: 1px solid #eee;">
            {{ $assets->links() }}
        </div>
    </div>
</div>
