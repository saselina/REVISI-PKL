<x-app-layout hideNavbar="true">
    {{-- Di sini tempat garis pink kemungkinan muncul --}}
    <x-slot name="header">
        {{-- Header Detail Barang - Warna Biru #647FBC --}}
        <h1 class="text-2xl font-semibold text-white bg-[#647FBC] p-4 text-center">
            Detail Barang
        </h1>
    </x-slot>

    {{-- Konten utama diatur agar memiliki latar belakang yang menutupi garis pink di bagian bawah header --}}
    <div class="py-8 px-6 bg-white min-h-screen">
        {{-- Menambahkan min-h-screen dan bg-white untuk menutupi warna background pink dari layout utama --}}

        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg border border-[#647FBC]">

            <h2 class="text-xl font-bold mb-4 text-center text-[#647FBC]">
                Informasi Barang
            </h2>

            <table class="w-full border-collapse border border-[#647FBC] text-black">
                <tr>
                    <td class="font-semibold w-40 p-2 border border-[#647FBC]">Nama Barang</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->nama_barang }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">Jenis</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->jenis_barang }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">Status</td>
                    <td class="p-2 border border-[#647FBC]">
                        @if ($item->status === 'Aktif')
                            <span class="text-green-600 font-bold">Aktif</span>
                        @else
                            <span class="text-red-600 font-bold">Tidak Aktif</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">Gedung</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->gedung }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">Ruangan</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->ruangan }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">User</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->user }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">Manufacture</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->manufacture }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">Serial Number</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->serial_number }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">Processor</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->processor }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">RAM</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->ram }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">SSD</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->ssd }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2 border border-[#647FBC]">HDD</td>
                    <td class="p-2 border border-[#647FBC]">{{ $item->hdd }}</td>
                </tr>
            </table>

            <div class="mt-6 text-center">
                <a href="/dashboard" wire:navigate class="px-4 py-2 bg-[#647FBC] text-white rounded hover:bg-[#5069A0]">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
