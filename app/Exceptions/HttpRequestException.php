<?php

namespace App\Exceptions;

use Exception;

class HttpRequestException extends Exception
{
    protected $httpCode;
    protected $success = false;
    protected $errors;
    protected $headers;
    protected $data;

    public function __construct($httpCode = 400, $message = "Bad Request", $errors = [], $data = null, Exception $previous = null, array $headers = [], $code = 0)
    {
        parent::__construct($message, $code, $previous);
        $this->httpCode = $httpCode;
        $this->message = $message;
        $this->errors = $errors;
        $this->headers = $headers;
        $this->data = $data;

    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    public function getData()
    {
        return $this->data;
    }
}
