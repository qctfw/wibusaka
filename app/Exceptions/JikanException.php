<?php

namespace App\Exceptions;

use Exception;

class JikanException extends HttpRequestException
{
    public function __construct($http_code = 503, $message = 'Jikan.moe API Error')
    {
        parent::__construct($http_code, $message);
    }
}
