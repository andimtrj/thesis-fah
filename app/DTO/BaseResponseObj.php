<?php

namespace App\DTO;


class BaseResponseObj
{
    /**
     * Create a new class instance.
     */

    public string $statusCode;
    public string $message;
    public ?object $data;

    public function __construct(string $statusCode = "", string $message = "", object $data = null)
    {
        //
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->data = $data;
    }
}
