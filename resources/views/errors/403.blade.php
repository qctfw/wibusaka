<x-error-layout>
    <x-slot name="code">403</x-slot>
    <x-slot name="message">
        <p>Anda tidak diizinkan untuk mengakses halaman ini. &bull; Kembali ke <a href="{{ route('index') }}" class="font-semibold hover:underline">halaman utama</a>.</p>
    </x-slot>
</x-error-layout>