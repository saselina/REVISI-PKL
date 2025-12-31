<div style="background-color: #ffffff; min-height: 100vh; padding: 40px 20px;">
    {{-- PINDAHKAN STYLE KE SINI AGAR TETAP DI DALAM ROOT DIV --}}
    <style>
        @keyframes popIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
    </style>

    <div style="max-width: 1240px; margin: 0 auto; background-color: #ffffff; padding: 30px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04); font-family: 'Inter', sans-serif;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h2 style="margin: 0; color: #1e293b; font-weight: 800; font-size: 26px; letter-spacing: -0.5px;">Data Inventaris Barang</h2>
                <p style="margin: 4px 0 0 0; color: #64748b; font-size: 14px;">Manajemen aset dan inventaris terpusat secara real-time.</p>
            </div>
            <a href="{{ route('assets.create') }}"
               style="background-color: #647FBC; color: #ffffff; padding: 12px 24px; border-radius: 12px; text-decoration: none; font-weight: 700; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(100, 127, 188, 0.2); transition: all 0.3s ease;">
                <span style="font-size: 20px; line-height: 0;">+</span> Tambah Barang
            </a>
        </div>

        {{-- Filter & Search --}}
        <div style="background-color: #ffffff; padding: 10px 16px; border-radius: 10px; border: 1px solid #f1f5f9; margin-bottom: 20px;">
            <div style="display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap;">
                <div style="width: 160px;">
                    <label style="display: block; margin-bottom: 4px; font-weight: 700; color: #64748b; font-size: 9px; text-transform: uppercase; letter-spacing: 0.5px;">Filter Lokasi</label>
                    <select wire:model.live="filterGedung"
                        style="width: 100%; padding: 4px 8px; border: 1px solid #e2e8f0; border-radius: 6px; background: #ffffff; font-size: 12px; color: #1e293b; outline: none; height: 32px;">
                        <option value="">Semua Lokasi</option>
                        @foreach($listGedung as $gedung)
                            <option value="{{ $gedung }}">{{ $gedung }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="width: 100%; max-width: 300px; margin-left: auto;">
                    <label style="display: block; margin-bottom: 4px; font-weight: 700; color: #64748b; font-size: 9px; text-transform: uppercase; letter-spacing: 0.5px;">Cari Barang</label>
                    <div style="position: relative; display: flex; align-items: center;">
                        <span style="position: absolute; left: 8px; color: #000000; font-size: 11px;">🔍</span>
                        <input type="text" wire:model.live.debounce.300ms="search"
                            placeholder="Cari nama atau merk..."
                            style="width: 100%; padding: 4px 30px 4px 28px; border: 1px solid #e2e8f0; border-radius: 6px; background: #ffffff; font-size: 12px; color: #000000; outline: none; height: 32px; box-sizing: border-box;">
                        <button type="button" wire:click="resetFilter" style="position: absolute; right: 4px; background: transparent; border: none; cursor: pointer;">
                            <img src="https://img.icons8.com/?size=100&id=59754&format=png&color=000000" style="width: 14px; height: 14px;">
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div style="background-color: #ffffff; border-radius: 16px; overflow: hidden; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #91ADC8; color: white;">
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; text-transform: uppercase; font-weight: 700; width: 50px;">NO</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; text-transform: uppercase; font-weight: 700;">Informasi Barang</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; text-transform: uppercase; font-weight: 700;">Lokasi Penempatan</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; text-transform: uppercase; font-weight: 700;">Status</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; text-transform: uppercase; font-weight: 700; width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($assets as $item)
                        @php
                            $statusText = strtolower($item->status);
                            $isGood = in_array($statusText, ['baik', 'aktif', 'kurang baik']);
                            $isBad = in_array($statusText, ['tidak aktif', 'rusak', 'sudah kusam', 'hilang', 'rusak berat']);
                            $bgColor = $isGood ? '#ecfdf5' : ($isBad ? '#fff1f2' : '#f8fafc');
                            $textColor = $isGood ? '#059669' : ($isBad ? '#e11d48' : '#64748b');
                            $borderColor = $isGood ? '#d1fae5' : ($isBad ? '#ffe4e6' : '#f1f5f9');
                        @endphp
                        <tr wire:key="asset-{{ $item->id }}" style="border-bottom: 1px solid #f8fafc;">
                            <td style="padding: 18px 20px; text-align: center; color: #94a3b8; font-weight: 600; font-size: 13px;">
                                {{ ($assets->currentPage() - 1) * $assets->perPage() + $loop->iteration }}
                            </td>
                            <td style="padding: 18px 20px;">
                                <div style="font-weight: 700; color: #1e293b; font-size: 15px;">{{ strtoupper($item->nama_barang) }}</div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 4px; display: flex; align-items: center; gap: 8px;">
                                    <span>{{ $item->manufacture ?? 'N/A' }}</span>
                                    <span style="width: 4px; height: 4px; background: #cbd5e1; border-radius: 50%;"></span>
                                    <span style="color: #647FBC; font-weight: 600; background: #eff6ff; padding: 2px 8px; border-radius: 6px;">{{ $item->kategori }}</span>
                                </div>
                            </td>
                            <td style="padding: 18px 20px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="font-size: 16px;">📍</div>
                                    <div>
                                        <div style="font-weight: 700; color: #334155; font-size: 14px;">{{ $item->gedung }}</div>
                                        <div style="font-size: 12px; color: #94a3b8;">{{ $item->lokasi }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 18px 20px; text-align: center;">
                                <span style="background: {{ $bgColor }}; color: {{ $textColor }}; border: 1px solid {{ $borderColor }}; padding: 6px 14px; border-radius: 8px; font-size: 11px; font-weight: 800; text-transform: uppercase; display: inline-block; min-width: 90px;">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td style="padding: 18px 20px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 8px;">
                                    <button wire:click="openModal({{ $item->id }})" title="Detail" style="border:1px solid #f1f5f9; cursor:pointer; padding: 8px; background: #f8fafc; border-radius: 8px; transition: 0.2s;">📄</button>
                                    <button wire:click="edit({{ $item->id }})" title="Edit" style="border:1px solid #f1f5f9; cursor:pointer; padding: 8px; background: #f8fafc; border-radius: 8px; transition: 0.2s;" onmouseover="this.style.background='#fef9c3'">✏️</button>
                                    <button wire:click="confirmDelete({{ $item->id }})" wire:confirm="Apakah Anda yakin ingin menghapus data ini?" title="Hapus" style="border:1px solid #f1f5f9; cursor:pointer; padding: 8px; background: #fff1f2; border-radius: 8px; transition: 0.2s;">🗑️</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="padding: 80px 20px; text-align: center; color: #94a3b8;">Data tidak ditemukan</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($assets->hasPages())
                <div style="padding: 20px; border-top: 1px solid #f1f5f9;">{{ $assets->links() }}</div>
            @endif
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    @if($isOpen && $itemDetail)
    <div style="position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px;">
        <div style="position: absolute; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);" wire:click="closeModal"></div>
        <div style="position: relative; background: #ffffff; width: 100%; max-width: 600px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden; animation: popIn 0.3s ease;">
            <div style="background: #647FBC; padding: 20px 25px; display: flex; justify-content: space-between; align-items: center; color: white;">
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 800;">Detail Spesifikasi</h3>
                    <p style="margin: 4px 0 0 0; font-size: 12px; opacity: 0.8;">{{ strtoupper($itemDetail->nama_barang) }}</p>
                </div>
                <button wire:click="closeModal" style="background: none; border: none; color: white; cursor: pointer; font-size: 24px;">&times;</button>
            </div>

            <div style="padding: 25px; max-height: 60vh; overflow-y: auto;">
                <div style="display: grid; gap: 10px;">
                    @php
                        $fields = [
                            'Kode Aset' => 'kode_aset',
                            'Kategori' => 'kategori',
                            'Manufacture' => 'manufacture',
                            'Gedung' => 'gedung',
                            'Ruangan' => 'lokasi',
                            'Status' => 'status',
                            'User' => 'user',
                            'Processor' => 'processor',
                            'RAM' => 'ram',
                            'SSD' => 'ssd',
                            'HDD' => 'hdd',
                            'SN' => 'serial_number'
                        ];
                    @endphp

                    @foreach($fields as $label => $column)
                        @php
                            $isIT = strtolower($itemDetail->kategori) == 'it';
                            $showField = ($column == 'kode_aset') ? !$isIT : !empty($itemDetail->$column);
                        @endphp

                        @if($showField)
                            <div style="display: flex; align-items: center; padding: 12px; background: {{ $column == 'kode_aset' ? '#fff1f2' : '#f8fafc' }}; border-radius: 10px; border: 1px solid {{ $column == 'kode_aset' ? '#fbcfcf' : '#f1f5f9' }};">
                                <div style="width: 130px; font-size: 10px; font-weight: 700; color: {{ $column == 'kode_aset' ? '#e11d48' : '#64748b' }}; text-transform: uppercase;">{{ $label }}</div>
                                <div style="flex: 1; font-size: 14px; color: #1e293b; font-weight: 600;">
                                    {{ $itemDetail->$column ?? '-' }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div style="padding: 20px; background: #f8fafc; text-align: right;">
                <button wire:click="closeModal" style="background: #647FBC; color: white; border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; cursor: pointer;">Tutup</button>
            </div>
        </div>
    </div>
    @endif

    {{-- MODAL EDIT --}}
    @if($isEditOpen)
    <div style="position: fixed; inset: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; padding: 20px;">
        <div style="position: absolute; inset: 0; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);" wire:click="closeModal"></div>
        <div style="position: relative; background: #ffffff; width: 100%; max-width: 900px; border-radius: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden; animation: popIn 0.3s ease;">
            <div style="background: #647FBC; padding: 20px 25px; display: flex; justify-content: space-between; align-items: center; color: white;">
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 800;">Edit Data Aset</h3>
                    <p style="margin: 4px 0 0 0; font-size: 12px; opacity: 0.8;">Perbarui informasi inventaris secara real-time</p>
                </div>
                <button wire:click="closeModal" style="background: none; border: none; color: white; cursor: pointer; font-size: 24px;">&times;</button>
            </div>

            <form wire:submit.prevent="update">
                <div style="padding: 25px; max-height: 75vh; overflow-y: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                    <div style="display: grid; gap: 15px;">
                        <h4 style="margin: 0; color: #647FBC; font-size: 14px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">📋 Informasi Umum</h4>

                        <div>
                            <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">NAMA BARANG</label>
                            <input type="text" wire:model="nama_barang" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                        </div>

                        {{-- INPUT KODE ASET --}}
                        @if(strtolower($kategori) != 'it')
                        <div style="animation: popIn 0.3s ease;">
                            <label style="display:block; font-size: 11px; font-weight: 700; color: #e11d48; margin-bottom: 5px;">KODE ASET</label>
                            <input type="text" wire:model="kode_aset" placeholder="Contoh: AST-2023-001" style="width:100%; padding: 10px; border: 1px solid #fbcfcf; border-radius: 8px; background: #fff1f2;">
                        </div>
                        @endif

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <div>
                                <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">KATEGORI</label>
                                <input type="text" wire:model.live="kategori" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                            </div>
                            <div>
                                <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">MANUFACTURE</label>
                                <input type="text" wire:model="manufacture" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                            </div>
                        </div>

                        <div>
                            <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">GEDUNG / LOKASI</label>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" wire:model="gedung" placeholder="Gedung" style="flex:1; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <input type="text" wire:model="lokasi" placeholder="Ruangan" style="flex:1; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                            </div>
                        </div>

                        <div>
                            <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">STATUS ASET</label>
                            <select wire:model="status" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; background: white;">
                                <option value="Baik">Baik / Aktif</option>
                                <option value="Kurang Baik">Kurang Baik</option>
                                <option value="Rusak">Rusak</option>
                                <option value="Hilang">Hilang</option>
                            </select>
                        </div>
                    </div>

                    <div style="display: grid; gap: 15px;">
                        <h4 style="margin: 0; color: #647FBC; font-size: 14px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px;">💻 Spesifikasi IT & User</h4>
                        <div>
                            <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">USER / PEMAKAI</label>
                            <input type="text" wire:model="user" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px; background: #fffbeb;">
                        </div>
                        <div>
                            <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">PROCESSOR</label>
                            <input type="text" wire:model="processor" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px;">
                            <div>
                                <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">RAM</label>
                                <input type="text" wire:model="ram" placeholder="8GB" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                            </div>
                            <div>
                                <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">SSD</label>
                                <input type="text" wire:model="ssd" placeholder="256GB" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                            </div>
                            <div>
                                <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">HDD</label>
                                <input type="text" wire:model="hdd" placeholder="1TB" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                            </div>
                        </div>
                        <div>
                            <label style="display:block; font-size: 11px; font-weight: 700; color: #64748b; margin-bottom: 5px;">SERIAL NUMBER (SN)</label>
                            <input type="text" wire:model="serial_number" style="width:100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                        </div>
                    </div>
                </div>

                <div style="padding: 20px 25px; background: #f8fafc; border-top: 1px solid #f1f5f9; text-align: right; display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" wire:click="closeModal" style="background: #e2e8f0; color: #475569; border: none; padding: 10px 20px; border-radius: 10px; font-weight: 700; cursor: pointer;">Batal</button>
                    <button type="submit" style="background: #647FBC; color: white; border: none; padding: 10px 30px; border-radius: 10px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(100, 127, 188, 0.3);">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
