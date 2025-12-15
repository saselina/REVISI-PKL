<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- FORM UPDATE PROFIL --}}
            @include('profile.partials.update-profile-information-form')

            {{-- GARIS PEMBATAS --}}
            <hr class="my-8">

            {{-- FORM UPDATE PASSWORD --}}
            @include('profile.partials.update-password-form')

        </div>
    </div>
</x-app-layout>
