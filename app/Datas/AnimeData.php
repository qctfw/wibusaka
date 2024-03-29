<?php

namespace App\Datas;

use ArrayAccess;
use Carbon\Carbon;
use ErrorException;
use ReflectionProperty;
use stdClass;

readonly class AnimeData implements ArrayAccess
{
    private const JIKAN_ANIME_EXPLICIT_GENRE_IDS = [9, 12, 49];

    public function __construct(
        public int $mal_id,
        public string $mal_url,
        public array $images,
        public ?string $trailer_url,
        public array $titles,
        public ?string $type,
        public string $source,
        public ?int $episodes,
        public string $status,
        public bool $is_airing,
        public ?Carbon $aired_from,
        public stdClass $aired_from_properties,
        public ?Carbon $aired_to,
        public stdClass $aired_to_properties,
        public ?Carbon $duration,
        public string $rating,
        public ?string $score,
        public ?int $rank,
        public int $popularity,
        public int $members,
        public int $favorites,
        public ?string $synopsis,
        public ?string $background,
        public ?string $season,
        public ?int $year,
        public ?array $broadcast,
        public ?string $premiered,
        public array $producers,
        public array $licensors,
        public array $studios,
        public array $genres,
        public array $explicit_genres,
        public array $themes,
        public array $demographics,
        public array $relations,
        public array $opening_themes,
        public array $ending_themes,
        public array $external_links,
    ) {}

    public static function fromJikan(array $data): self
    {
        $trailer_url = filled($data['trailer']['youtube_id']) ? 'https://youtu.be/' . $data['trailer']['youtube_id'] : null;

        $titles = collect($data['titles'])
            ->groupBy(fn ($value) => strtolower($value['type']))
            ->map(fn ($value) =>  $value->pluck('title'));

        if (!$titles->offsetExists('english'))
            $titles['english'] = [];
        if (!$titles->offsetExists('japanese'))
            $titles['japanese'] = [];
        if (!$titles->offsetExists('synonym'))
            $titles['synonym'] = [];

        $status = __('anime.single.status_enums.' . str($data['status'])->replace(' ', '_')->lower());
        $status = __($status);

        $aired_from = null;
        if (filled($data['aired']['from']))
            $aired_from = Carbon::parse($data['aired']['from'])
                ->shiftTimezone($data['broadcast']['timezone'])
                ->setTimeFrom($data['broadcast']['time'])
                ->setTimezone(config('app.timezone'));

        $aired_to = null;
        if (filled($data['aired']['to']))
            $aired_to = Carbon::parse($data['aired']['to'])
                ->shiftTimezone($data['broadcast']['timezone'])
                ->setTimeFrom($data['broadcast']['time'])
                ->setTimezone(config('app.timezone'));

        $properties = ($data['aired']['string'] != 'Not available') ? explode(' to ', $data['aired']['string']) : [null, null];
        $aired_from_properties = static::parseAiredProperties(@$properties[0]);
        $aired_to_properties = static::parseAiredProperties(@$properties[1]);

        $duration = null;
        if (filled($data['duration']) && $data['duration'] != 'Unknown')
            $duration = Carbon::createFromTimestamp(0)->startOfDay()
                ->add(
                    str_replace(
                        ['hr', 'min', 'sec', 'per ep'],
                        ['hour', 'minute', 'second', ''],
                        $data['duration']
                    )
                );

        $rating = (filled($data['rating'])) ? explode(' - ', $data['rating'])[0] : 'None';

        $score = ($data['score'] > 0) ? number_format($data['score'], 2, '.', '') : null;

        $broadcast = null;
        if ((filled($data['broadcast']['time']) && filled($data['broadcast']['timezone']))) {
            $broadcast_carbon = Carbon::parse($data['broadcast']['day'])
                ->shiftTimezone($data['broadcast']['timezone'])
                ->setTimeFrom($data['broadcast']['time'])
                ->setTimezone(config('app.timezone'));
            $broadcast = [
                'carbon' => $broadcast_carbon,
                'day' => $broadcast_carbon->dayName,
                'time' => $broadcast_carbon->format('H:i'),
                'timezone' => $broadcast_carbon->tzName,
                'string' => __('anime.single.broadcast_string', [
                    'day' => $broadcast_carbon->dayName,
                    'time' => $broadcast_carbon->format('H:i T')
                ])
            ];
        }

        $premiered = (!empty($data['season']) && !empty($data['year'])) ? str($data['season'])->ucfirst() . ' ' . $data['year'] : null;

        $explicit_genres = collect($data['explicit_genres']);

        $genres = collect($data['genres'])->filter(function ($genre) use ($explicit_genres) {
            if (in_array($genre['mal_id'], self::JIKAN_ANIME_EXPLICIT_GENRE_IDS)) {
                $explicit_genres->push($genre)->values();
                return false;
            }
            return true;
        });

        return new self(
            $data['mal_id'],
            $data['url'],
            $data['images'],
            $trailer_url,
            $titles->toArray(),
            $data['type'],
            $data['source'],
            $data['episodes'],
            $status,
            $data['airing'],
            $aired_from,
            $aired_from_properties,
            $aired_to,
            $aired_to_properties,
            $duration,
            $rating,
            $score,
            $data['rank'],
            $data['popularity'],
            $data['members'],
            $data['favorites'],
            $data['synopsis'],
            $data['background'],
            $data['season'],
            $data['year'],
            $broadcast,
            $premiered,
            $data['producers'],
            $data['licensors'],
            $data['studios'],
            $genres->toArray(),
            $explicit_genres->toArray(),
            $data['themes'],
            $data['demographics'],
            $data['relations'] ?? [],
            $data['theme']['openings'] ?? [],
            $data['theme']['endings'] ?? [],
            $data['external'] ?? []
        );
    }

    public function offsetSet($offset, $value): void
    {
        throw new ErrorException('This class is read-only');
    }

    public function offsetExists($offset): bool
    {
        return property_exists($this, $offset);
    }

    public function offsetUnset($offset): void
    {
        throw new ErrorException('This class is read-only');
    }

    public function offsetGet($offset): mixed
    {
        if (!property_exists($this, $offset)) {
            throw new ErrorException('Undefined key `'. $offset . '`');
        }

        if (!(new ReflectionProperty($this, $offset))->isPublic()) {
            throw new ErrorException('Key `'. $offset . '` is not accessible');
        }

        return $this->$offset;
    }

    private function airedFormat(?Carbon $date, stdClass $date_properties, $format): string
    {
        if (blank($date)) return '?';

        if (!$date_properties->has_day)
            $format = str_replace(['d', 'D', 'j', 'l', 'N', 'S', 'w', 'z', 'W'], '', $format);
        if (!$date_properties->has_month)
            $format = str_replace(['F', 'm', 'M', 'n', 't'], '', $format);
        if (!$date_properties->has_year)
            $format = str_replace(['L', 'o', 'X', 'x', 'Y', 'y'], '', $format);

        $format = trim($format);

        return $date->translatedFormat($format);
    }

    public function airedFromFormat(string $format): string
    {
        return $this->airedFormat($this->aired_from, $this->aired_from_properties, $format);
    }

    public function airedFromShortFormat(): string
    {
        return $this->airedFromFormat('d F Y');
    }

    public function airedFromLongFormat(): string
    {
        return $this->airedFromFormat('d M Y');
    }

    public function airedToFormat(string $format): string
    {
        return $this->airedFormat($this->aired_to, $this->aired_to_properties, $format);
    }

    public function airedToShortFormat(): string
    {
        return $this->airedToFormat('d F Y');
    }

    public function airedToLongFormat(): string
    {
        return $this->airedToFormat('d M Y');
    }

    public function durationFormat(): ?string
    {
        if (blank($this->duration)) return null;

        $result = '';
        if ($this->duration->hour > 0) $result .= $this->duration->hour . ' jam ';
        if ($this->duration->minute > 0) $result .= $this->duration->minute . ' menit ';
        if ($this->duration->second > 0) $result .= $this->duration->second . ' detik ';

        return trim($result);
    }

    /**
     * Parse `aired` properties. Originally from ToshY with a little changes.
     *
     * @author ToshY
     * @link https://github.com/jikan-me/jikan/issues/486#issuecomment-1289619241
     * @link https://onlinephp.io/c/34793
     */
    private static function parseAiredProperties(?string $aired): stdClass
    {
        $aired ??= '';

        $properties = [
            'has_year' => false,
            'has_month' => false,
            'has_day' => false
        ];

        if (preg_match('/^[A-Z][a-z]{2,3} \d{1,2}, \d{4}$/', $aired) === 1) {
            $properties['has_year'] = true;
            $properties['has_month'] = true;
            $properties['has_day'] = true;
        }
        elseif (preg_match('/^[A-Z][a-z]{2,3} \d{4}$/', $aired) === 1) {
            $properties['has_year'] = true;
            $properties['has_month'] = true;
        }
        elseif (preg_match('/^[A-z][a-z]{2,3} \d{1,2}$/', $aired) === 1) {
            $properties['has_month'] = true;
            $properties['has_day'] = true;
        }
        elseif (preg_match('/^\d{4}$/', $aired) === 1) {
            $properties['has_year'] = true;
        }

        return (object) $properties;
    }
}

