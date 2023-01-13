<div class="group relative inline-block">
    {{ $menu }}
    <div class="absolute z-30 mt-2 invisible opacity-0 transition-all duration-100 group-focus-within:visible group-focus-within:opacity-100">
        {{ $slot }}
    </div>
</div>
