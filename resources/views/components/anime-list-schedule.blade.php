<div class="grid items-start grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
    @forelse ($animes as $anime)
        <x-anime-list-schedule-single :anime="$anime" :resources="$resources[$anime['mal_id']] ?? []" />
    @empty
        @isset($day)
        <p class="italic w-full">Tidak ada anime yang tayang hari {{ strtolower($day) }}.</p>
        @else
        <p class="italic w-full">Tidak ada anime yang tayang.</p>
        @endisset
    @endforelse
</div>
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
                        let days = Math.floor(this.countdown / (3600 * 24)).toString();

                        if (days > 0)
                        {
                            this.timerString = `${days} hari`;
                            clearInterval(countdownInterval);
                        }
                        else
                        {
                            let hours = Math.floor(this.countdown % (3600 * 24) / 3600).toString().padStart(2, '0');
                            let minutes = Math.floor(this.countdown % 3600 / 60).toString().padStart(2, '0');
                            let seconds = Math.floor(this.countdown % 60).toString().padStart(2, '0');

                            this.timerString = `${hours}:${minutes}:${seconds}`;
                        }
                    }

                    this.countdown--;
                }, 1000);
            }
        }));
    });
</script>
