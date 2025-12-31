<div style="background-color: #ffffff; min-height: 100vh; font-family: 'Inter', sans-serif; padding: 40px;">
    <style>
        .input-group { position: relative; margin-bottom: 5px; }
        .custom-input, .custom-select {
            width: 100%; padding: 14px 18px; border-radius: 12px; border: 2px solid #e2e8f0;
            background: #ffffff; font-size: 15px; font-weight: 500; color: #1e293b;
            outline: none; transition: all 0.2s ease; box-sizing: border-box;
        }
        .custom-input:focus, .custom-select:focus {
            border-color: #3b82f6; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .custom-select {
            appearance: none; cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 18px center; background-size: 18px;
        }
        .label-text {
            display: block; font-weight: 800; margin-bottom: 10px; color: #334155;
            font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .form-card {
            background: white; padding: 40px; border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05); border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .btn-submit {
            background: #2563eb; color: white; padding: 16px 35px; border-radius: 14px;
            border: none; font-weight: 800; cursor: pointer; font-size: 16px;
            transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        .btn-submit:hover { background: #1d4ed8; transform: translateY(-2px); }

        .it-details {
            grid-column: span 2; background: #f8fafc; padding: 25px;
            border-radius: 20px; border: 2px dashed #cbd5e1;
            display: grid; grid-template-columns: 1fr 1fr; gap: 20px;
            margin-top: 10px; animation: slideDown 0.4s ease-out;
        }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div style="max-width: 850px; margin: 0 auto;">
        <div style="margin-bottom: 30px;">
            <h2 style="font-weight: 900; color: #0f172a; font-size: 32px; letter-spacing: -1px; margin-bottom: 8px;">Tambah Aset Baru</h2>
            <p style="color: #64748b; font-weight: 500; font-size: 16px;">Lengkapi detail informasi aset inventaris Anda.</p>
        </div>

        <div class="form-card">
            <form wire:submit.prevent="save">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">

                    {{-- Nama Barang --}}
                    <div style="grid-column: span 2;">
                        <label class="label-text">Nama Barang</label>
                        <input type="text" wire:model="nama_barang" class="custom-input" placeholder="Misal: MacBook Pro M2 Max">
                        @error('nama_barang') <span style="color: #ef4444; font-size: 12px;">{{ $message }}</span> @enderror
                    </div>

                    {{-- Kategori & Brand --}}
                    <div>
                        <label class="label-text">Kategori</label>
                        <select wire:model.live="kategori" class="custom-select">
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label-text">Brand / Merk</label>
                        <input type="text" wire:model="manufacture" class="custom-input" placeholder="Misal: Apple, Dell, HP">
                    </div>

                    {{-- Type & SN --}}
                    <div>
                        <label class="label-text">Type / Model</label>
                        <input type="text" wire:model="type" class="custom-input" placeholder="Misal: A2779">
                    </div>
                    <div>
                        <label class="label-text">Serial Number (SN)</label>
                        <input type="text" wire:model="sn" class="custom-input" placeholder="Masukkan nomor seri">
                    </div>

                    {{-- STATUS ASET (DINAMIS BERDASARKAN KATEGORI) --}}
                    <div style="grid-column: span 2;">
                        <label class="label-text">Status Aset</label>
                        <select wire:model="status" class="custom-select">
                            <option value="">-- Pilih Status --</option>
                            @if($kategori == 'IT' || $kategori == 'Laptop' || $kategori == 'Komputer')
                                {{-- Status Khusus IT --}}
                                <option value="Aktif">✅ AKTIF</option>
                                <option value="Tidak Aktif">❌ TIDAK AKTIF</option>
                            @else
                                {{-- Status Kategori Lainnya --}}
                                <option value="Baik">👍 BAIK</option>
                                <option value="Sudah Kusam">⏳ SUDAH KUSAM</option>
                                <option value="Kurang Baik">⚠️ KURANG BAIK</option>
                                <option value="Rusak">🚨 RUSAK</option>
                            @endif
                        </select>
                    </div>

                    {{-- Penempatan --}}
                    <div>
                        <label class="label-text">Gedung</label>
                        <select wire:model="gedung" class="custom-select">
                            <option value="">Pilih Gedung...</option>
                            @foreach($buildings as $bld)
                                <option value="{{ $bld }}">{{ $bld }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="label-text">Lokasi / Ruangan</label>
                        <select wire:model="lokasi" class="custom-select">
                            <option value="">Pilih Ruangan...</option>
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}">{{ $loc }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- SPESIFIKASI TAMBAHAN IT --}}
                    @if($kategori == 'IT' || $kategori == 'Laptop' || $kategori == 'Komputer')
                    <div class="it-details">
                        <div style="grid-column: span 2; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px;">
                            <h3 style="margin: 0; font-size: 16px; color: #1e293b;">💻 Spesifikasi Teknis IT</h3>
                        </div>
                        <div>
                            <label class="label-text">Processor</label>
                            <input type="text" wire:model="processor" class="custom-input" placeholder="Misal: Core i7">
                        </div>
                        <div>
                            <label class="label-text">RAM (GB)</label>
                            <input type="number" wire:model="ram" class="custom-input" placeholder="16">
                        </div>
                        <div>
                            <label class="label-text">Penyimpanan SSD</label>
                            <input type="text" wire:model="ssd" class="custom-input" placeholder="512 GB">
                        </div>
                        <div>
                            <label class="label-text">Penyimpanan HDD</label>
                            <input type="text" wire:model="hdd" class="custom-input" placeholder="1 TB">
                        </div>
                    </div>
                    @endif

                </div>

                <div style="margin-top: 45px; display: flex; align-items: center; justify-content: space-between; border-top: 1px solid #f1f5f9; padding-top: 30px;">
                    <a href="{{ route('assets.index') }}" style="color: #64748b; text-decoration: none; font-weight: 700; font-size: 15px;">
                        ← Batal & Kembali
                    </a>
                    <button type="submit" class="btn-submit">💾 Simpan Aset Baru</button>
                </div>
            </form>
        </div>
    </div>
</div>
