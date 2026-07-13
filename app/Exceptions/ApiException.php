<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiException extends Exception
{
    protected int $statusCode;
    protected string $errorName;

    public function __construct(string $errorName, string $message, int $statusCode = 400)
    {
        parent::__construct($message, $statusCode);
        $this->statusCode = $statusCode;
        $this->errorName = $errorName;
    }

    public function render($request): JsonResponse
    {
        return response()->json(['error' => [
            'code' => $this->statusCode,
            'name' => $this->errorName,
            'message' => $this->getMessage()
        ]], $this->statusCode);
    }
}
