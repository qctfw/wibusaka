<x-app-layout>
    <x-slot name="title">{{ __('meta.default.title') }}</x-slot>

    <section class="flex flex-col items-center gap-12 px-10 py-24 bg-green-900 max-w-screen md:py-32 lg:py-36 font-primary bg-opacity-30 lg:flex-row">
        <div class="flex flex-col w-full gap-4 lg:w-1/2">
            <h1 class="font-extrabold text-7xl">{{ config('app.name') }}</h1>
            <p class="text-xl font-semibold">{{ __('meta.default.description') }}</p>
            <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
                <x-button-link href="{{ route('anime.index') }}">
                    <x-slot name="icon">
                        <x-icons.chevron-right-solid class="w-8 h-8" />
                    </x-slot>
    
                    <p class="font-semibold text-md font-primary md:text-lg xl:text-xl">{{ __('Anime Sekilas') }}</p>
                </x-button-link>
                <x-button-link href="{{ route('anime.season-current') }}">
                    <x-slot name="icon">
                        <x-icons.chevron-right-solid class="w-8 h-8" />
                    </x-slot>
    
                    <p class="font-semibold text-md font-primary md:text-lg xl:text-xl">{{ __('anime.season.current') }}</p>
                </x-button-link>
                <x-button-link href="{{ route('anime.top.rated') }}">
                    <x-slot name="icon">
                        <x-icons.chevron-right-solid class="w-8 h-8" />
                    </x-slot>
    
                    <p class="font-semibold text-md font-primary md:text-lg xl:text-xl">{{ __('anime.top.title.rated') }}</p>
                </x-button-link>
            </div>
        </div>
        <div class="flex flex-col w-full gap-4 lg:w-1/2">
            <h2 class="text-4xl font-bold">Cari Sekarang!</h2>
            <livewire:search-landing-page />
        </div>
    </section>

    <section class="flex flex-col items-center gap-12 px-10 py-24 bg-green-900 bg-opacity-40 dark:bg-opacity-50 max-w-screen md:py-32 lg:py-36 font-primary lg:flex-row">
        <div class="flex flex-col w-full gap-4 lg:w-1/2">
            <img src="https://via.placeholder.com/1280x500/124F4F/FFF?text=Placeholder.com" />
        </div>
        <div class="flex flex-col w-full gap-4 text-right lg:w-1/2">
            <h2 class="font-extrabold text-7xl">Kenapa {{ config('app.name') }}?</h2>
            <p class="text-lg font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus architecto quibusdam, ad tempora, nostrum vitae, impedit at perferendis odit id est. Quis, tenetur! Laudantium libero non pariatur totam facere veniam eos recusandae, minima suscipit optio. Dolores voluptatum quas veritatis esse deleniti id magnam consequatur ipsam voluptas laboriosam? Quas, in tenetur?</p>
        </div>
    </section>

    <section class="flex flex-col items-center gap-12 px-10 py-24 bg-green-900 max-w-screen md:py-32 lg:py-36 bg-opacity-30 font-primary lg:flex-row">
        <div class="flex flex-col w-full gap-4 lg:w-1/2">
            <h2 class="font-extrabold text-7xl">Tujuan {{ config('app.name') }}</h2>
            <p class="text-lg font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus architecto quibusdam, ad tempora, nostrum vitae, impedit at perferendis odit id est. Quis, tenetur! Laudantium libero non pariatur totam facere veniam eos recusandae, minima suscipit optio. Dolores voluptatum quas veritatis esse deleniti id magnam consequatur ipsam voluptas laboriosam? Quas, in tenetur?</p>
        </div>
        <div class="flex flex-col w-full gap-4 lg:w-1/2">
            <img src="https://via.placeholder.com/1280x500/124F4F/FFF?text=Placeholder.com" />
        </div>
    </section>

    <section class="flex flex-col items-center gap-12 px-10 py-20 bg-green-900 bg-opacity-40 dark:bg-opacity-50 max-w-screen font-primary lg:flex-row">
        <div class="flex flex-col w-full gap-4 text-center">
            <h2 class="text-5xl font-extrabold">FAQ {{ config('app.name') }}</h2>
            <div class="flex flex-col items-center gap-3 px-8 md:px-10 lg:px-24">
                <x-accordion>
                    <x-slot name="title">Test Pertanyaan 1</x-slot>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, debitis ab esse itaque odio quam temporibus ea ipsam quaerat numquam assumenda nihil, modi neque necessitatibus aspernatur! Magni autem, eos aperiam dolor veritatis, eveniet nulla minima quod cumque, consequatur rerum iure harum facilis magnam? Neque laboriosam, beatae iure dolorum deserunt ipsum odit perferendis error consectetur inventore expedita aliquam mollitia deleniti tenetur aperiam explicabo quidem. Doloribus neque cum unde quae dolor molestiae, vitae nesciunt! Facere error voluptate quasi voluptates illum in accusantium quam at ut labore, numquam omnis nulla corrupti suscipit officiis fuga sit facilis temporibus amet esse ratione. Odit, eveniet sit.</p>
                </x-accordion>
                <x-accordion>
                    <x-slot name="title">Test Pertanyaan 2</x-slot>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, debitis ab esse itaque odio quam temporibus ea ipsam quaerat numquam assumenda nihil, modi neque necessitatibus aspernatur! Magni autem, eos aperiam dolor veritatis, eveniet nulla minima quod cumque, consequatur rerum iure harum facilis magnam? Neque laboriosam, beatae iure dolorum deserunt ipsum odit perferendis error consectetur inventore expedita aliquam mollitia deleniti tenetur aperiam explicabo quidem. Doloribus neque cum unde quae dolor molestiae, vitae nesciunt! Facere error voluptate quasi voluptates illum in accusantium quam at ut labore, numquam omnis nulla corrupti suscipit officiis fuga sit facilis temporibus amet esse ratione. Odit, eveniet sit.</p>
                </x-accordion>
                <x-accordion>
                    <x-slot name="title">Test Pertanyaan 3</x-slot>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, debitis ab esse itaque odio quam temporibus ea ipsam quaerat numquam assumenda nihil, modi neque necessitatibus aspernatur! Magni autem, eos aperiam dolor veritatis, eveniet nulla minima quod cumque, consequatur rerum iure harum facilis magnam? Neque laboriosam, beatae iure dolorum deserunt ipsum odit perferendis error consectetur inventore expedita aliquam mollitia deleniti tenetur aperiam explicabo quidem. Doloribus neque cum unde quae dolor molestiae, vitae nesciunt! Facere error voluptate quasi voluptates illum in accusantium quam at ut labore, numquam omnis nulla corrupti suscipit officiis fuga sit facilis temporibus amet esse ratione. Odit, eveniet sit.</p>
                </x-accordion>
                <x-accordion>
                    <x-slot name="title">Test Pertanyaan 4</x-slot>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, debitis ab esse itaque odio quam temporibus ea ipsam quaerat numquam assumenda nihil, modi neque necessitatibus aspernatur! Magni autem, eos aperiam dolor veritatis, eveniet nulla minima quod cumque, consequatur rerum iure harum facilis magnam? Neque laboriosam, beatae iure dolorum deserunt ipsum odit perferendis error consectetur inventore expedita aliquam mollitia deleniti tenetur aperiam explicabo quidem. Doloribus neque cum unde quae dolor molestiae, vitae nesciunt! Facere error voluptate quasi voluptates illum in accusantium quam at ut labore, numquam omnis nulla corrupti suscipit officiis fuga sit facilis temporibus amet esse ratione. Odit, eveniet sit.</p>
                </x-accordion>
                <x-accordion>
                    <x-slot name="title">Test Pertanyaan 5</x-slot>
                    <p class="text-lg">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, debitis ab esse itaque odio quam temporibus ea ipsam quaerat numquam assumenda nihil, modi neque necessitatibus aspernatur! Magni autem, eos aperiam dolor veritatis, eveniet nulla minima quod cumque, consequatur rerum iure harum facilis magnam? Neque laboriosam, beatae iure dolorum deserunt ipsum odit perferendis error consectetur inventore expedita aliquam mollitia deleniti tenetur aperiam explicabo quidem. Doloribus neque cum unde quae dolor molestiae, vitae nesciunt! Facere error voluptate quasi voluptates illum in accusantium quam at ut labore, numquam omnis nulla corrupti suscipit officiis fuga sit facilis temporibus amet esse ratione. Odit, eveniet sit.</p>
                </x-accordion>
            </div>
        </div>
    </section>

    <section class="flex flex-col items-center gap-12 px-10 py-20 bg-green-900 max-w-screen bg-opacity-30 font-primary lg:flex-row">
        <div class="flex flex-col items-center w-full">
            <div class="flex flex-row items-center gap-8 dark:text-white">
                <a href="{{ config('anime.link.github') }}" target="_blank">
                    <x-icons.github class="w-16 h-16 transition-colors duration-150 hover:text-green-300 dark:hover:text-gray-300" fill="currentColor" />
                </a>
                {{--
                <a href="{{ config('anime.link.twitter') }}" target="_blank">
                    <x-icons.twitter class="w-16 h-16 transition-colors duration-150 hover:text-green-300 dark:hover:text-gray-300" fill="currentColor" />
                </a>
                --}}
                <a href="{{ config('anime.link.discord') }}" target="_blank">
                    <x-icons.discord class="w-16 h-16 transition-colors duration-150 hover:text-green-300 dark:hover:text-gray-300" fill="currentColor" />
                </a>
            </div>
        </div>
    </section>
</x-app-layout>