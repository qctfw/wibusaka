<x-error-layout>
    <x-slot name="code">500</x-slot>
    <x-slot name="message">
        <p>Error: {{ get_class($exception) }}</p>
        <p>{{ __('error.internal_server_error') }}</p>
        <p>Kembali ke <a href="{{ route('index') }}" class="font-semibold hover:underline">halaman utama</a>.</p>
    </x-slot>
</x-error-layout>
