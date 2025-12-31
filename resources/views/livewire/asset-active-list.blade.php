<div style="font-family: 'Inter', sans-serif; background-color: #fcfcfc; padding: 30px; border-radius: 3px;">

    <div style="margin-bottom: 30px;">
        <h1 style="margin: 0; font-size: 28px; font-weight: 800; color: #1a202c;">Data Inventaris Barang Aktif</h1>
        <p style="margin: 5px 0 0 0; color: #718096; font-size: 15px;">Daftar aset yang tersedia dan sedang beroperasi secara real-time.</p>
    </div>

    <div style="background-color: #ffffff; padding: 10px 16px; border-radius: 3px; border: 1px solid #f1f5f9; margin-bottom: 20px;">
        <div style="display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap;">

            <div style="width: 160px;">
                <label style="display: block; margin-bottom: 4px; font-weight: 700; color: #64748b; font-size: 9px; text-transform: uppercase; letter-spacing: 0.5px;">Filter Lokasi</label>
                <select wire:model.live="filterGedung"
                    style="width: 100%; padding: 4px 8px; border: 1px solid #e2e8f0; border-radius: 3px; background: #ffffff; font-size: 12px; color: #1e293b; outline: none; cursor: pointer; height: 32px;">
                    <option value="">Semua Lokasi</option>
                    @foreach($listGedung as $gedung)
                        <option value="{{ $gedung }}">{{ $gedung }}</option>
                    @endforeach
                </select>
            </div>

            <div style="width: 100%; max-width: 300px; margin-left: auto;">
                <label style="display: block; margin-bottom: 4px; font-weight: 700; color: #64748b; font-size: 9px; text-transform: uppercase; letter-spacing: 0.5px;">Cari Barang</label>
                <div style="position: relative; display: flex; align-items: center;">

                    <span style="position: absolute; left: 8px; color: #000000; font-size: 11px; pointer-events: none;">🔍</span>

                    <input type="text" wire:model.live.debounce.300ms="search"
                        placeholder="Cari nama atau merk..."
                        style="width: 100%; padding: 4px 30px 4px 28px; border: 1px solid #e2e8f0; border-radius: 3px; background: #ffffff; font-size: 12px; color: #000000; outline: none; height: 32px; box-sizing: border-box;">

                    <button type="button" wire:click="resetFilter" title="Reset Filter"
                        style="position: absolute; right: 4px; background: transparent; border: none; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; cursor: pointer; padding: 0; border-radius: 3px; transition: all 0.2s;"
                        onmouseover="this.style.background='#f1f5f9'"
                        onmouseout="this.style.background='transparent'">
                        <img src="https://img.icons8.com/?size=100&id=59754&format=png&color=000000"
                             alt="reset"
                             style="width: 14px; height: 14px; opacity: 1;">
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div style="background-color: white; border-radius: 3px; overflow: hidden; border: 1px solid #edf2f7; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #91adc8; color: white;">
                    <th style="padding: 18px; text-align: center; width: 60px; font-size: 12px; text-transform: uppercase;">No</th>
                    <th style="padding: 18px; text-align: left; font-size: 12px; text-transform: uppercase;">Informasi Barang</th>
                    <th style="padding: 18px; text-align: left; font-size: 12px; text-transform: uppercase;">Lokasi Penempatan</th>
                    <th style="padding: 18px; text-align: center; font-size: 12px; text-transform: uppercase;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $index => $item)
                    <tr style="border-bottom: 1px solid #f7fafc; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 20px; text-align: center; font-weight: 700; color: #cbd5e0;">{{ $assets->firstItem() + $index }}</td>
                        <td style="padding: 20px;">
                            <div style="font-weight: 800; color: #2d3748; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px;">{{ $item->nama_barang }}</div>
                            <div style="font-size: 12px; color: #a0aec0; margin-top: 5px; display: flex; align-items: center; gap: 8px;">
                                <span>{{ $item->merk ?? 'Generic' }}</span>
                                <span style="color: #e2e8f0;">|</span>
                                <span style="background-color: #ebf4ff; color: #5a67d8; padding: 2px 8px; border-radius: 3px; font-weight: 700; font-size: 10px;">{{ $item->kategori }}</span>
                            </div>
                        </td>
                        <td style="padding: 20px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <span style="color: #e53e3e; font-size: 18px;">📍</span>
                                <div>
                                    <div style="font-weight: 800; color: #4a5568; font-size: 15px;">{{ $item->gedung }}</div>
                                    <div style="font-size: 12px; color: #a0aec0;">{{ $item->ruangan ?? 'Area Kerja' }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 20px; text-align: center;">
                            <span style="background-color: #f0fff4; color: #38a169; padding: 8px 25px; border-radius: 3px; font-size: 12px; font-weight: 800; border: 1px solid #c6f6d5; text-transform: uppercase;">
                                AKTIF
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 100px; text-align: center;">
                            <div style="font-size: 40px;">🔍</div>
                            <p style="color: #a0aec0; font-size: 16px; margin-top: 10px;">Tidak ada aset aktif yang cocok dengan pencarian Anda.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="padding: 20px; background-color: #fdfdfd; border-top: 1px solid #edf2f7;">
            {{ $assets->links() }}
        </div>
    </div>
</div>
