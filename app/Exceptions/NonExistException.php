<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class NonExistException extends Exception
{
    public function report()
    {
        Log::channel('site')->error($this->getMessage());
    }

    public function render($request)
    {
        return response()->view('errors.m500');
    }
}
