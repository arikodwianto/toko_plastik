<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3>Selamat datang, {{ auth()->user()->name }}!</h3>

                <!-- Tampilkan tombol hanya untuk Owner -->
                @if (auth()->user()->role === 'owner')
                    <div class="mt-4">
                        <a href="{{ route('owner.users.create') }}"
                           class="btn btn-primary px-4 py-2 rounded bg-blue-600 text-white">
                           ➕ Tambah User
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
