<?php

declare(strict_types=1);

namespace App\Rest\Entity;

class ErrorMessage
{
    private string $error_message;

    public function __construct(string $errorMessage)
    {
        $this->error_message = $errorMessage;
    }

    public function getErrorMessage(): string
    {
        return $this->error_message;
    }
}