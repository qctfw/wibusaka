<div {{ $attributes->merge(['class' => 'flex flex-col']) }}>
    {{ $title ?? '' }}
    <div class="grid items-stretch grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
        {{ $slot }}
    </div>
</div>
<script>
    document.addEventListener('alpine:init', () => {
        if (!('titleLanguage' in localStorage)) {
            localStorage.titleLanguage = 'romaji';
        }

        Alpine.store('titleLanguage', localStorage.titleLanguage);
    });

    function changeTitleLanguage(lang) {
        localStorage.titleLanguage = lang;
        console.log(localStorage.titleLanguage);
    }
</script>
