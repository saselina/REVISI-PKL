<x-slot:title>Edit Barang</x-slot:title>

<div style="padding: 20px; background-color: #f7f7f7;">

    <div style="background-color: white; padding: 25px; border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); border: 1px solid #eee;">

        <div style="margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
            <h2 style="font-size: 20px; font-weight: 600; color: #333; margin: 0; display: flex; align-items: center;">
                <span style="font-size: 24px; color: #6f42c1; margin-right: 10px;">✏️</span>
                Edit Barang
            </h2>
        </div>

        @if (session('statusMessage'))
            <div style="margin-bottom: 15px; padding: 12px; background-color: #d1fae5;
                        color: #065f46; border-radius: 6px;">
                {{ session('statusMessage') }}
            </div>
        @endif

        {{-- Asumsikan Anda memiliki properti $itemId di Livewire component untuk ID barang yang diedit --}}
        <form wire:submit.prevent="update">
            <input type="hidden" wire:model="itemId"> {{-- Input tersembunyi untuk ID barang --}}

            {{-- GEDUNG - RUANGAN - KATEGORI --}}
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 20px;">

                {{-- GEDUNG --}}
                <div>
                    <label>Gedung</label>
                    <select wire:model.live="gedung"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                        <option value="">-- Pilih Gedung --</option>
                        <option value="Gedung Office">Gedung Office</option>
                        <option value="Gedung Store">Gedung Store</option>
                        <option value="Gedung Sc">Gedung Sc</option>
                    </select>
                    @error('gedung') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                {{-- RUANGAN (Opsi disortir berdasarkan Gedung yang dipilih) --}}
                <div>
                    <label>Ruangan</label>
                    <select wire:model="ruangan"
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;"
                        {{-- Nonaktifkan jika Gedung belum dipilih --}}
                        @if (!$gedung) disabled @endif>

                        <option value="">-- Pilih Ruangan --</option>

                        @if ($gedung === 'Gedung Office')
                            <option value="R HRD">R HRD</option>
                            <option value="R Purchasing">R Purchasing</option>
                            <option value="R Direktor">R Direktor</option>
                            <option value="R Finance">R Finance</option>
                            <option value="R Accounting">R Accounting</option>
                            <option value="R Meeting">R Meeting</option>
                            <option value="R Sales">R Sales</option>
                            <option value="Resepsionis">Resepsionis</option>
                            <option value="R CSU">R CSU</option>

                        @elseif ($gedung === 'Gedung Store')
                            <option value="BOD">BOD</option>
                            <option value="Store">Store</option>

                        @elseif ($gedung === 'Gedung Sc')
                            <option value="R Meeting">R Meeting</option>
                            <option value="R Service Manager">R Service Manager</option>
                            <option value="R Warehouse">R Warehouse</option>
                        @endif
                    </select>
                    @error('ruangan') <span style="color:red">{{ $message }}</span> @enderror
                </div>

                {{-- KATEGORI --}}
                <div>
                    <label>Kategori</label>
                    <select wire:model="kategori"
                        style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Furniture">Furniture</option>
                        <option value="IT">IT</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Vehicle / Kendaraan">Vehicle / Kendaraan</option>
                        <option value="Peralatan Kantor">Peralatan Kantor</option>
                    </select>
                    @error('kategori') <span style="color:red">{{ $message }}</span> @enderror
                </div>

            </div>

            {{-- NAMA BARANG --}}
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">

                <div>
                    <label>Nama Barang</label>
                    <input type="text" wire:model="nama_barang"
                           style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    @error('nama_barang') <span style="color:red">{{ $message }}</span> @enderror
                </div>

            </div>

            <div style="border-top: 1px solid #eee; padding-top: 20px; margin-top: 20px;">
                <h3 style="margin-bottom: 15px;">Detail Tambahan</h3>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">

                    <div>
                        <label>Jenis</label>
                        <input type="text" wire:model="jenis_barang"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>Type</label>
                        <input type="text" wire:model="type"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>Manufacture</label>
                        <input type="text" wire:model="manufacture"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>S/N</label>
                        <input type="text" wire:model="sn"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>Processor</label>
                        <input type="text" wire:model="proc"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>RAM</label>
                        <input type="text" wire:model="ram"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>SSD</label>
                        <input type="text" wire:model="ssd"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>HDD</label>
                        <input type="text" wire:model="hdd"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                    <div>
                        <label>Status</label>
                        <select wire:model="status"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                            <option value="">-- Pilih Status --</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Perawatan">Perawatan</option>
                        </select>
                    </div>

                    <div>
                        <label>User</label>
                        <input type="text" wire:model="user"
                                 style="width:100%; padding:10px; border:1px solid #ccc; border-radius:6px;">
                    </div>

                </div>
            </div>

            {{-- BUTTON --}}
            <div style="margin-top: 30px; display: flex; gap: 10px;
                        border-top: 1px solid #eee; padding-top: 20px;">

                {{-- Tombol untuk menyimpan perubahan --}}
                <button type="submit"
                        style="background-color: #3b82f6; color:white; padding:10px 20px;
                               border-radius:6px; border:none; cursor:pointer;">
                    💾 Simpan Perubahan
                </button>

                {{-- Tombol untuk kembali ke halaman sebelumnya --}}
                <button type="button" onclick="window.history.back()"
                        style="background-color: #e5e7eb; padding:10px 20px;
                               border-radius:6px; border:none; cursor:pointer;">
                    ⬅️ Kembali
                </button>

            </div>

        </form>
    </div>
</div>
