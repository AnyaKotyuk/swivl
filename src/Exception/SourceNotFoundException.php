<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SourceNotFoundException extends NotFoundHttpException
{
    private const ERROR_MESSAGE = 'Source %s not found';

    public function __construct(string $sourceName)
    {
        $message = sprintf(self::ERROR_MESSAGE, $sourceName);

        parent::__construct($message);
    }
}