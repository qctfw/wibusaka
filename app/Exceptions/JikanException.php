<?php

namespace App\Exceptions;

use Exception;

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
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->view('errors.jikan', [
            'code' => $this->code,
            'message' => $this->message
        ], 500);
    }
}
