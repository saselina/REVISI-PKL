<div>
    <form wire:submit.prevent="save" class="space-y-4">

    <input type="text" wire:model="nama_barang" placeholder="Nama Barang" class="input">
    <input type="text" wire:model="jenis" placeholder="Jenis" class="input">

    <select wire:model="status" class="input">
        <option value="Aktif">Aktif</option>
        <option value="Nonaktif">Nonaktif</option>
    </select>

    <input type="text" wire:model="gedung" placeholder="Gedung" class="input">
    <input type="text" wire:model="ruangan" placeholder="Ruangan" class="input">
    <input type="text" wire:model="user" placeholder="User" class="input">
    <input type="text" wire:model="manufacture" placeholder="Manufacture" class="input">
    <input type="text" wire:model="serial_number" placeholder="Serial Number" class="input">
    <input type="text" wire:model="processor" placeholder="Processor" class="input">
    <input type="text" wire:model="ram" placeholder="RAM" class="input">
    <input type="text" wire:model="ssd" placeholder="SSD" class="input">
    <input type="text" wire:model="hdd" placeholder="HDD" class="input">

    <button type="submit" class="btn-primary">Simpan</button>

</form>


</div>
