<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function report()
    {
        return '';
    }

    public function render()
    {
        return response()->json(['message' => $this->message], 406);
    }
}
