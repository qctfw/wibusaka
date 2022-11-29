<x-error-layout>
    <x-slot name="code">500</x-slot>
    <x-slot name="message">
        <p>Error: {{ get_class($exception) }}</p>
        <p>{{ __('error.internal_server_error') }}</p>
    </x-slot>
</x-error-layout>