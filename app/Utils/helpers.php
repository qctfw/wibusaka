<?php

if (!function_exists('abbreviate_number'))
{
    function abbreviate_number(int $number = null)
    {
        if (is_null($number))
        {
            return '?';
        }

        if (strlen($number) <= 3)
        {
            return $number;
        }
        elseif (strlen($number) <= 6)
        {
            $abb_text = 'rb';
        }
        elseif (strlen($number) <= 9)
        {
            $abb_text = 'jt';
        }
        elseif (strlen($number) <= 12)
        {
            $abb_text = 'M';
        }

        $first_three_numbers = substr($number, 0, 3);
        
        $decimal_pos = strlen($number) % 3;
        if ($decimal_pos == 0)
        {
            $final_num = $first_three_numbers;
        }
        else
        {
            $num_before_comma = substr($first_three_numbers, 0, $decimal_pos);
            $num_after_comma = rtrim(substr($first_three_numbers, $decimal_pos - 3), '0');

            $final_num = strlen($num_after_comma) == 0 ? $num_before_comma : $num_before_comma . '.' . $num_after_comma;
        }

        return $final_num . ' ' . $abb_text;
    }
}

if (!function_exists('validate_page')) {
    function validate_page($page, $total_page = null)
    {
        if (is_null($total_page))
        {
            return preg_match('/^\d+$/', $page) && $page > 0;
        }

        return preg_match('/^\d+$/', $page) && $page > 0 && $page <= $total_page;
    }
}

if (!function_exists('guess_site')) {
    function guess_site(string $url)
    {
        $parsed_url = ltrim(parse_url($url, PHP_URL_HOST), 'www.');
        $parsed_url = explode('.', $parsed_url, 2)[0];
        
        return $parsed_url;
    }
}

if (!function_exists('logo_asset')) {
    function logo_asset(string $path) {
        return config('anime.asset.base_url') . '/' . $path;
    }
}

if (!function_exists('randomize_logo')) {
    function randomize_logo() {
        $chance = 10; // 10%

        if (session()->missing('logorandom'))
        {
            session()->flash('logorandom', rand(0, 100));
        }

        return (session('logorandom') <= $chance) ? logo_asset(config('anime.asset.logo.jp')) : logo_asset(config('anime.asset.logo.default'));
    }
}
