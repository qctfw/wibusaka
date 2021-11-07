<x-error-layout>
    <x-slot name="code">404</x-slot>
    <x-slot name="message">
        <p>Halaman tidak ditemukan. &bull; Kembali ke <a href="{{ route('index') }}" class="font-semibold hover:underline">halaman utama</a>.</p>
    </x-slot>
</x-error-layout>