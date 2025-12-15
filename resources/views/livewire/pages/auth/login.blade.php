<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        session()->flash('welcome_popup', true); // FITUR ANDA

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

{{-- CONTAINER UTAMA: Background Biru Penuh (bg-blue-700) --}}
{{-- Class 'min-h-screen' untuk tinggi minimal layar penuh. --}}
{{-- Class 'flex items-center justify-center' untuk menengahkan kartu login secara vertikal dan horizontal. --}}
<div class="min-h-screen flex items-center justify-center bg-blue-400 p-8 sm:p-8">
    {{-- KARTU LOGIN (Warna #F8F8F8) --}}
    {{-- Tambahkan 'max-w-md' dan 'w-full' agar responsif, dan 'rounded-xl' untuk sudut melengkung. --}}
    <div class="max-w-md w-full p-8 bg-[#F8F8F8] rounded-xl shadow-6xl">
        {{-- Warna kartu login disamakan dengan background logo --}}

        {{-- HEADER LOGO & JUDUL --}}
        <div class="flex flex-col items-center justify-center mb-8">

            {{-- BAGIAN LOGO FALENTRA GROUP --}}
            <div class="mb-4 w-2/3 max-w-xs">
                <img src="{{ asset('images/FALENTRA.PNG.jpeg') }}"
                    alt="Logo Falentra Group"
                    class="w-full h-auto object-contain"
                    onerror="this.onerror=null; this.src='https://placehold.co/200x60/F8F8F8/000000?text=FALENTRA';"
                />
            </div>
            {{-- AKHIR BAGIAN LOGO FALENTRA GROUP --}}

            {{-- Judul Sistem Informasi --}}
            <h1 class="text-xl font-bold text-gray-900 text-center mt-4">
                Sistem Informasi Data Aset
            </h1>
            <h2 class="text-sm text-gray-600 text-center font-semibold mt-1 mb-6">
                Perusahaan
            </h2>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form wire:submit="login">

            {{-- FIELD EMAIL / USERNAME --}}
            <div class="mb-5">
                <label for="email" class="sr-only">Username</label>
                <div class="relative">
                    {{-- Ikon Pengguna --}}
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>

                    {{-- INPUT UNDERLINE --}}
                    <x-text-input
                        wire:model="form.username"
                        id="username"
                        type="text"
                        name="username"
                        required
                        autocomplete="username"
                        class="
                            pl-10
                            block w-full
                            border-0
                            border-b-2
                            border-gray-300
                            focus:border-indigo-500
                            focus:ring-0
                            placeholder-gray-500
                            bg-transparent
                        "
                        placeholder="Username"
                    />

                    <x-input-error :messages="$errors->get('form.username')" class="mt-2" />
                </div>
            </div>

            {{-- FIELD PASSWORD --}}
            <div class="mb-5">
                <label for="password" class="sr-only">Password</label>
                <div class="relative">

                    {{-- Ikon Kunci --}}
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>

                    {{-- INPUT PASSWORD --}}
                    <input
                        type="password"
                        id="password-field"
                        wire:model="form.password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Password"
                        class="
                            pl-11 pr-10 w-full
                            border-0 border-b-2 border-gray-300
                            focus:border-indigo-500 focus:ring-0
                            bg-transparent
                            text-gray-700 placeholder-gray-500
                        "
                    />

                    {{-- ICON TOGGLE EYE BUTTON --}}
                    {{-- Gunakan z-10 untuk memastikan tombol berada di atas input --}}
                    <button type="button"
                        id="toggle-password"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer z-10">

                        {{-- Ikon 'Show Password' (Mata Terbuka) - Terlihat Secara Default --}}
                        <svg id="icon-show" class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        {{-- Ikon 'Hide Password' (Mata Tertutup) - Tersembunyi Secara Default --}}
                        <svg id="icon-hide" class="w-5 h-5 text-gray-400 hidden" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.133 0 2.228.17 3.25.475M16 12a4 4 0 10-8 0M12 14v2"/>
                        </svg>

                    </button>
                </div>

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            {{-- TOMBOL LOGIN --}}
            <div class="flex flex-col items-center justify-center mt-8">
                <button type="submit"
                    class="w-full justify-center py-3 bg-blue-400 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 text-white font-bold rounded-full shadow-lg transition duration-150 ease-in-out">
                    {{-- Loading State --}}
                    <span wire:loading.remove wire:target="login">LOGIN</span>
                    <span wire:loading wire:target="login">Loading...</span>
                </button>

                {{-- FOOTER / COPYRIGHT --}}
                <div class="text-center mt-10 text-xs text-gray-500">
                    &copy; 2025 - Sistem Informasi.
                </div>
            </div>

        </form>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // PERBAIKAN: Memastikan background biru memenuhi seluruh layar dengan menambahkan class h-full ke body
        // Class ini membantu 'min-h-screen' pada div utama bekerja dengan benar.
        document.body.classList.add('h-full', 'min-h-full', 'antialiased');

        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password-field');
        const iconShow = document.getElementById('icon-show'); // Mata Terbuka
        const iconHide = document.getElementById('icon-hide'); // Mata Tertutup

        if (togglePassword && passwordField) {
            togglePassword.addEventListener('click', function (e) {
                // Mencegah Livewire menganggap ini sebagai submit form
                e.preventDefault();

                // Toggle tipe input antara 'password' dan 'text'
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Toggle ikon visibilitas
                iconShow.classList.toggle('hidden');
                iconHide.classList.toggle('hidden');

                // Fokuskan kembali pada input setelah di-toggle untuk pengalaman pengguna yang lebih baik
                passwordField.focus();
            });
        }
    });
</script>
