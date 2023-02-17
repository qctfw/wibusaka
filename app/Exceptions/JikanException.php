<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JikanException extends Exception
{
    public $code;

    public $message;

    public function __construct(int $code = 500, string $message = '')
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response()->view('errors.jikan', [
            'code' => $this->code,
            'message' => $this->message
        ], 500);
    }
}
