<div style="background-color: #ffffff; padding: 25px; border-radius: 15px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">

    <div style="display: flex; gap: 20px; align-items: flex-end; margin-bottom: 30px;">
        <div style="display: flex; flex-direction: column; gap: 8px;">
            <label style="font-size: 11px; font-weight: 800; color: #475569; letter-spacing: 0.5px; text-transform: uppercase;">Gedung</label>
            <select wire:model="filterGedung" style="padding: 10px 15px; border-radius: 10px; border: 1px solid #e2e8f0; min-width: 220px; background-color: #fff; color: #1e293b; outline: none;">
                <option value="">-- Semua Gedung --</option>
                @foreach($listGedung as $gedung)
                    <option value="{{ $gedung }}">{{ $gedung }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; flex-direction: column; gap: 8px;">
            <label style="font-size: 11px; font-weight: 800; color: #475569; letter-spacing: 0.5px; text-transform: uppercase;">Kategori</label>
            <select wire:model="filterKategori" style="padding: 10px 15px; border-radius: 10px; border: 1px solid #e2e8f0; min-width: 220px; background-color: #fff; color: #1e293b; outline: none;">
                <option value="">-- Semua Kategori --</option>
                @foreach($listKategori as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button wire:click="tampilkan" style="background-color: #6259ca; color: white; padding: 11px 25px; border-radius: 10px; border: none; cursor: pointer; font-weight: 600;">
                Tampilkan
            </button>
            <button wire:click="resetFilter" style="background-color: #f8fafc; color: #475569; padding: 11px 20px; border-radius: 10px; border: 1px solid #e2e8f0; cursor: pointer;">
                Reset
            </button>
        </div>
    </div>

    <hr style="border: 0; border-top: 1px solid #f1f5f9; margin-bottom: 25px;">

    @if($showTable)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #91ADC8; color: white;">
                        <th style="padding: 15px; border-top-left-radius: 10px; text-align: center; width: 50px;">NO</th>
                        <th style="padding: 15px; text-align: left;">Informasi Barang</th>
                        <th style="padding: 15px; text-align: left;">Lokasi</th>
                        <th style="padding: 15px; text-align: left;">Kategori</th>
                        <th style="padding: 15px; text-align: center; border-top-right-radius: 10px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $index => $item)
                        <tr style="border-bottom: 1px solid #f8fafc; transition: 0.2s;" onmouseover="this.style.backgroundColor='#fcfcfc'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 15px; text-align: center; color: #64748b;">{{ $assets->firstItem() + $index }}</td>
                            <td style="padding: 15px;">
                                <div style="font-weight: 600; color: #1e293b;">{{ $item->nama_barang }}</div>
                                <div style="font-size: 11px; color: #94a3b8;">{{ $item->kode_barang ?? '-' }}</div>
                            </td>
                            <td style="padding: 15px; color: #475569;">{{ $item->gedung }}</td>
                            <td style="padding: 15px; color: #475569;">{{ $item->kategori ?? '-' }}</td>
                            <td style="padding: 15px; text-align: center;">
                                <span style="background-color: #fee2e2; color: #991b1b; padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                                Tidak ada data aset non-aktif yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                {{ $assets->links() }}
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 80px 20px; background-color: #fafbfc; border: 2px dashed #f1f5f9; border-radius: 15px;">
            <div style="font-size: 50px; margin-bottom: 15px;">🚫</div>
            <h3 style="color: #334155; margin-bottom: 8px;">Laporan Aset Tidak Aktif</h3>
            <p style="color: #94a3b8; font-size: 14px;">Silakan pilih filter di atas, lalu klik <strong>Tampilkan</strong> untuk memuat data.</p>
        </div>
    @endif
</div>
