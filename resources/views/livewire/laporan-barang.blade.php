<div style="background-color: #ffffff; padding: 20px; border-radius: 12px; border: 1px solid #f1f5f9;">
    <div style="display: flex; gap: 15px; align-items: flex-end; margin-bottom: 25px; flex-wrap: wrap;">

        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label style="font-size: 12px; font-weight: bold; color: #64748b;">GEDUNG</label>
            <select wire:model="filterGedung" style="padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; min-width: 200px; background-color: #fff;">
                <option value="">-- Semua Gedung --</option>
                @foreach($listGedung as $gedung)
                    <option value="{{ $gedung }}">{{ $gedung }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; flex-direction: column; gap: 5px;">
            <label style="font-size: 12px; font-weight: bold; color: #64748b;">KATEGORI</label>
            <select wire:model="filterKategori" style="padding: 10px; border-radius: 8px; border: 1px solid #e2e8f0; min-width: 200px; background-color: #fff;">
                <option value="">-- Semua Kategori --</option>
                @foreach($listKategori as $kategori)
                    <option value="{{ $kategori }}">{{ $kategori }}</option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 10px;">
            <button wire:click="tampilkan" style="background-color: #6259ca; color: white; padding: 10px 25px; border-radius: 8px; border: none; cursor: pointer; font-weight: 500;">
                Tampilkan
            </button>

            <button wire:click="resetFilter" style="background-color: #f1f5f9; color: #334155; padding: 10px 20px; border-radius: 8px; border: 1px solid #e2e8f0; cursor: pointer;">
                Reset
            </button>
        </div>
    </div>

    @if($showTable)
        <div style="margin-top: 20px; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                <thead>
                    <tr style="background-color: #91ADC8; color: white;">
                        <th style="padding: 15px; border-top-left-radius: 8px;">NO</th>
                        <th style="padding: 15px; text-align: left;">Informasi Barang</th>
                        <th style="padding: 15px; text-align: left;">Lokasi</th>
                        <th style="padding: 15px; text-align: left;">Kategori</th>
                        <th style="padding: 15px; border-top-right-radius: 8px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $index => $item)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 12px; text-align: center; color: #64748b;">{{ $assets->firstItem() + $index }}</td>
                            <td style="padding: 12px; font-weight: 500;">{{ $item->nama_barang }}</td>
                            <td style="padding: 12px; color: #475569;">{{ $item->gedung }}</td>
                            <td style="padding: 12px; color: #475569;">{{ $item->kategori }}</td>
                            <td style="padding: 12px; text-align: center;">
                                <span style="padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold; background-color: {{ $item->status == 'Aktif' || $item->status == 'Baik' ? '#dcfce7' : '#fee2e2' }}; color: {{ $item->status == 'Aktif' || $item->status == 'Baik' ? '#166534' : '#991b1b' }};">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                                <div style="font-size: 14px;">Data tidak ditemukan untuk filter ini.</div>
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
        <div style="text-align: center; padding: 60px; border: 2px dashed #f1f5f9; border-radius: 12px; background-color: #fafbfc;">
            <div style="font-size: 40px; margin-bottom: 10px;">📊</div>
            <h3 style="color: #334155; margin: 0;">Siap Menampilkan Laporan</h3>
            <p style="color: #94a3b8; font-size: 14px; margin-top: 8px;">Silakan pilih Gedung dan Kategori di atas, lalu klik <strong>Tampilkan</strong>.</p>
        </div>
    @endif
</div>
