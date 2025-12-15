<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- HANYA AKTIFKAN INI DULU --}}
            {{-- @if (isset($user)) @livewire('profile.update-profile-information-form', ['user' => $user]) @endif --}}

            @livewire('profile.update-password-form')

            {{-- @livewire('profile.delete-user-form') --}}
        </div>
    </div>
</x-app-layout>
