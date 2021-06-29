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