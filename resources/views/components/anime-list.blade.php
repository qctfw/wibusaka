<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>
    {{ $title ?? '' }}
    <div class="grid items-stretch grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
        {{ $slot }}
    </div>
</div>