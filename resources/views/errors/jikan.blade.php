<x-error-layout>
    <x-slot name="title">Jikan Error</x-slot>
    <x-slot name="code">500</x-slot>
    <x-slot name="message">
        <p>{{ __('error.jikan_api') }}</p>
        <p>Pesan Error: ({{ $code }}) {{ $message }}</p>
        <p>Kembali ke <a href="{{ route('index') }}" class="font-semibold hover:underline">halaman utama</a>.</p>
    </x-slot>
</x-error-layout>
