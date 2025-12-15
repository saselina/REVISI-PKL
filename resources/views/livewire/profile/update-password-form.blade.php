<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

new class extends Component {
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules()
    {
        return [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function updatePassword()
    {
        // Jalankan validasi rules()
        $this->validate();

        $user = auth()->user();

        // Validasi Password Lama
        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password lama tidak sesuai.');
            return;
        }

        // Validasi Password Baru tidak boleh sama dengan yang lama (Penting!)
        if (Hash::check($this->password, $user->password)) {
            $this->addError('password', 'Password baru tidak boleh sama dengan password lama.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Password berhasil diperbarui.');
        $this->reset(['current_password', 'password', 'password_confirmation']);
    }
};
?>

<div class="bg-white shadow-xl rounded-lg w-full max-w-4xl mx-auto">

    <div class="bg-blue-600 text-white px-8 py-4 rounded-t-lg">
        <h2 class="text-xl font-semibold">Ubah Password</h2>
    </div>

    <div class="p-8">

        @if (session()->has('success'))
            <div class="mb-6 p-3 bg-green-100 text-green-700 border border-green-300 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="updatePassword" class="space-y-6">

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password Lama <span class="text-red-500">*</span></label>
                <input type="password" wire:model="current_password"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-blue-600 focus:border-blue-600" />
                @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password Baru <span class="text-red-500">*</span></label>
                <input type="password" wire:model="password"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-blue-600 focus:border-blue-600" />
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Konfirmasi Password Baru <span class="text-red-500">*</span></label>
                <input type="password" wire:model="password_confirmation"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:ring-blue-600 focus:border-blue-600" />
                {{-- Error untuk konfirmasi password akan ditampilkan di bawah Password Baru karena menggunakan 'confirmed' rule --}}
            </div>

            <div class="pt-4">
                <button
                    type="submit"
                    class="px-6 py-2 rounded-md bg-blue-600 text-white hover:bg-blue-700 font-medium shadow transition duration-150">
                    Simpan
                </button>
            </div>

        </form>

    </div>
</div>
