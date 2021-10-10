<footer x-data="{open: false, menu: ''}" class="fixed bottom-0 w-full p-4">
    <section class="flex flex-row items-center justify-center gap-4">
        <div class="text-link cursor-pointer" x-on:click="open = true; menu = 'privacy';">{{ __('anime.main.privacy') }}</div>
        <div class="text-link cursor-pointer" x-on:click="open = true; menu = 'faq';">{{ __('anime.main.faq') }}</div>
        <div class="text-link cursor-pointer" x-on:click="open = true; menu = 'credits';">{{ __('anime.main.credits') }}</div>
    </section>
    <div class="flex flex-row items-center justify-center gap-4 mt-2">
        <a href="{{ config('anime.link.github') }}" target="_blank">
            <x-icons.github class="w-6 h-6" fill="currentColor" />
        </a>
        {{--
        <a href="{{ config('anime.link.twitter') }}" target="_blank">
            <x-icons.twitter class="w-6 h-6" fill="currentColor" />
        </a>
        --}}
        <a href="{{ config('anime.link.discord') }}" target="_blank">
            <x-icons.discord class="w-6 h-6" fill="currentColor" />
        </a>
    </div>

    <x-modal>
        <x-slot name="header">
            <h3 x-show="menu === 'privacy'" class="text-2xl font-bold">{{ __('anime.main.privacy') }}</h3>
            <h3 x-show="menu === 'faq'" class="text-2xl font-bold">{{ __('anime.main.faq') }}</h3>
            <h3 x-show="menu === 'credits'" class="text-2xl font-bold">{{ __('anime.main.credits') }}</h3>
            <button x-on:click="open = false">
                <x-icons.x class="w-6 h-6" />
            </button>
        </x-slot>

        <div class="flex flex-col gap-4 overflow-y-auto dark:text-gray-200">
            <template x-if="menu === 'privacy'">
                <p>Akan diisi nanti</p>
            </template>
            <template x-if="menu === 'faq'">
                <p>Akan diisi nanti</p>
            </template>
            <template x-if="menu === 'credits'">
                <section class="flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <div class="text-xl font-semibold">Art</div>
                        <div class="gap-1">
                            <p>Logo designed by <a href="https://instagram.com/azrildrpna" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">@azrildrpna</a></p>
                            <p>Icons designed by <a href="https://heroicons.com" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">Heroicons</a></p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="text-xl font-semibold">Website</div>
                        <div class="gap-1">
                            <p>Built with <a href="https://tailwindcss.com" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">Tailwind CSS</a>, <a href="https://alpinejs.dev" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">Alpine.js</a>, <a href="https://laravel.com" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">Laravel</a>, and <a href="https://laravel-livewire.com" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">Livewire</a></p>
                            <p>API powered by <a href="https://api.jikan.moe" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">Jikan.moe</a> (Unofficial <a href="https://myanimelist.net" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">MyAnimeList</a> API)</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="text-xl font-semibold">Fonts</div>
                        <p>These fonts are provided by <a href="https://fonts.google.com" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">Google Fonts</a> with <a href="https://scripts.sil.org/OFL" target="_blank" rel="noopener noreferrer" class="text-link font-semibold">SIL Open Font License, 1.1</a></p>
                        <div class="flex flex-col gap-4">
                            <x-accordion>
                                <x-slot name="title">Lato</x-slot>
                                <div class="px-2 font-sans">
                                    <p>Lato-Hairline.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-HairlineItalic.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-Light.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-LightItalic.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-Regular.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-Italic.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-Bold.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-BoldItalic.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-Black.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                    <p>Lato-BlackItalic.ttf: Copyright (c) 2010-2011 by tyPoland Lukasz Dziedzic (team@latofonts.com) with Reserved Font Name "Lato". Licensed under the SIL Open Font License, Version 1.1.</p>
                                </div>
                                </p>
                            </x-accordion>
                            <x-accordion>
                                <x-slot name="title"><span class="font-primary">Catamaran</span></x-slot>
                                <div class="px-2 font-primary">
                                    <p>Catamaran[wght].ttf: Copyright 2020 The Catamaran Project Authors (https://github.com/VanillaandCream/Catamaran-Tamil)</p>
                                </div>
                            </x-accordion>
                            <x-accordion>
                                <x-slot name="title"><span class="font-jp">M PLUS 1p </span><span class="font-jp font-medium">「日本語フォント」</span></x-slot>
                                <div class="px-2 font-jp">
                                    <p>MPLUS1p-Regular.ttf: Copyright 2016 The M+ Project Authors.</p>
                                    <p>MPLUS1p-Medium.ttf: Copyright 2016 The M+ Project Authors.</p>
                                    <p>MPLUS1p-Bold.ttf: Copyright 2016 The M+ Project Authors.</p>
                                </div>
                            </x-accordion>
                        </div>
                    </div>
                </section>
            </template>
        </div>
    </x-modal>
</footer>