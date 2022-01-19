<x-app-layout>
    <x-slot name="title">{{ __('anime.schedule.title') }} Hari {{ $active_day }}</x-slot>
    <x-slot name="meta_title">{{ __('meta.schedule.description') }}</x-slot>

    <div class="flex flex-col items-center justify-between gap-2 pb-4 md:flex-row">
        <div class="flex flex-col items-center font-bold text-blue-700 dark:text-blue-300">
            <x-title>{{ __('anime.schedule.title') }} Hari {{ $active_day }}</x-title>
        </div>
        <div class="relative inline-block w-32" x-data="{}" x-init="$refs.dayselector.value = '{{ request('day') }}'">
            <select
            x-ref="dayselector"
            x-on:change="window.location.href = '{{ route('anime.schedule', [], false) }}/' + $event.target.value;"
            class="w-full h-10 px-4 text-lg rounded-md appearance-none bg-emerald-100 dark:bg-gray-800 focus:outline-none focus:ring focus:ring-emerald-300">
                <option value="monday">Senin</option>
                <option value="tuesday">Selasa</option>
                <option value="wednesday">Rabu</option>
                <option value="thursday">Kamis</option>
                <option value="friday">Jum'at</option>
                <option value="saturday">Sabtu</option>
                <option value="sunday">Minggu</option>
            </select>
            <div class="absolute inset-y-0 right-2 pointer-events-none flex items-center">
                <x-icons.chevron-down-solid class="w-6 h-6" />
            </div>
        </div>
    </div>

    <div class="grid items-start grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($animes as $anime)
        <div class="flex flex-col bg-gray-100 rounded-lg dark:bg-gray-800">
            <div class="flex flex-row h-44 md:h-40 lg:h-52 2xl:h-64">
                <a href="{{ route('anime.show', $anime['mal_id']) }}" rel="nofollow" class="relative w-1/3 mx-auto h-44 md:h-40 lg:h-52 2xl:h-64 anime-cover">
                    <div class="flex flex-col items-center justify-center w-1/2 mx-auto h-72 spinner">
                        <x-icons.spinner class="block w-5 h-5" />
                    </div>
                    <img alt="{{ $anime['title'] }} Anime Poster" data-src="{{ $anime['images']['webp']['image_url'] }}" class="absolute inset-x-0 top-0 max-w-full max-h-full mx-auto opacity-0 rounded-l" loading="lazy" />
                    @if (!$anime['explicit_genres']->isEmpty())
                    <div x-data="{showCover: false}" x-on:click.prevent="showCover = true" x-show="!showCover" class="absolute inset-x-0 top-0 flex items-center justify-center w-full h-full text-gray-200 backdrop-blur">
                        <div class="flex items-center px-2 py-1 bg-gray-800 rounded">Lihat</div>
                    </div>
                    @endif
                </a>
                <div class="relative flex flex-col w-2/3 gap-1 px-2 pt-2 divide-y divide-gray-400 shadow divide-opacity-50 divide-dashed">
                    <div class="flex flex-col gap-1 text-sm xl:text-base">
                        <div x-data="{ title: `{{ $anime['title'] }}` }" class="flex">
                            <a
                                href="{{ route('anime.show', $anime['mal_id']) }}"
                                rel="nofollow"
                                class="font-semibold leading-none font-primary text-link"
                                x-bind:class="title.length <= 50 ? 'text-lg xl:text-xl 2xl:text-2xl' : title.length <= 80 ? 'text-md 2xl:text-lg' : 'text-sm'"
                                x-text="title"></a>
                        </div>
                        @if ($anime['studios']->isNotEmpty())
                        <div class="flex-row hidden lg:flex">
                            <p><span class="font-semibold">Studio</span>: 
                            @foreach ($anime['studios'] as $studio)
                            {{ $studio['name'] }}{{ (!$loop->last) ? ',' : '' }}
                            @endforeach
                            </p>
                        </div>
                        @endif
                        @if ($anime['genres']->isNotEmpty())
                        <div class="hidden lg:flex">
                            <p><span class="font-semibold">Genre</span>: 
                                @foreach ($anime['genres'] as $genre)
                                    <a href="{{ route('anime.genre.show', ['slug' => str_replace(' ', '-', strtolower($genre['name']))]) }}" class="text-link">{{ $genre['name'] }}</a>{{ (!$loop->last) ? ',' : '' }}
                                @endforeach
                            </p>
                        </div>
                        @endif
                        <div class="grid grid-cols-2 lg:text-base">
                            <div class="flex flex-row items-center gap-2 text-left lg:text-md">
                                <x-icons.user-solid class="w-5 h-5" />
                                <span>{{ $anime['members'] }}</span>
                            </div>
                            <div class="flex flex-row items-center gap-2 text-left lg:text-md">
                                <x-icons.star-solid class="w-5 h-5" />
                                <span>{{ $anime['score'] }}</span>
                            </div>
                        </div>
                        <div class="flex">
                            <p class="text-sm lg:text-md">Tayang setiap pukul {{ $anime['broadcast']['time'] }} WIB</p>
                        </div>
                    </div>
                    <div x-data="countdownData({{ $anime['time_difference'] }}, {{ explode(' ', $anime['duration'])[0] }})" x-init="countdownTimer()" class="absolute inset-x-0 bottom-0 flex flex-row items-center justify-between gap-1 p-2 md:flex-col lg:flex-row">
                        <div class="text-md timer lg:text-lg xl:text-xl 2xl:text-2xl" x-text="timerString"></div>
                        <div class="flex flex-row items-center justify-center gap-3 p-1 bg-gray-200 bg-opacity-80 dark:bg-gray-900 dark:bg-opacity-60">
                            @forelse ($resources[$anime['mal_id']] as $resource)
                            <a href="{{ $resource->link }}" target="_blank" class="w-6 h-6 lg:w-7 lg:h-7" title="{{ $resource->alternative_note }}">
                                <img src="{{ logo_asset($resource->platform->icon_path) }}" alt="{{ $resource->platform->name }} Logo" />
                            </a>
                            @empty
                            <x-icons.x class="w-6 h-6 lg:w-7 lg:h-7" />
                            <span class="text-sm lg:text-md">{{ __('anime.single.availability_empty_short') }}</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <x-slot name="script">
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('countdownData', (countdown, minPerEp = 0) => ({
                    countdown: countdown,
                    minPerEp: minPerEp,
                    timerString: 'Memuat...',
                    aired: false,
                    countdownTimer: function () {
                        let countdownInterval = setInterval(() => {
                            if (this.countdown < (this.minPerEp * 60 * -1)) {
                                this.timerString = 'Selesai';
                                clearInterval(countdownInterval);
                                
                                return;
                            }
                            else if (this.countdown < 0) {
                                this.timerString = 'Sedang Tayang';
                            }
                            else {
                                let days = Math.floor(this.countdown / (3600 * 24)).toString().padStart(2, '0');
                                let hours = Math.floor(this.countdown % (3600 * 24) / 3600).toString().padStart(2, '0');
                                let minutes = Math.floor(this.countdown % 3600 / 60).toString().padStart(2, '0');
                                let seconds = Math.floor(this.countdown % 60).toString().padStart(2, '0');

                                if (days > 0)
                                {
                                    this.timerString = `${days}:${hours}:${minutes}:${seconds}`;
                                }
                                else
                                {
                                    this.timerString = `${hours}:${minutes}:${seconds}`;
                                }
                            }

                            this.countdown--;
                        }, 1000);
                    }
                }));
            });
        </script>
    </x-slot>
</x-app-layout>