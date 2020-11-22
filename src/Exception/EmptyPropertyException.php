<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class EmptyPropertyException extends BadRequestHttpException
{
    private const ERROR_MESSAGE = 'Property %s can\'t be empty';

    public function __construct(string $propertyName)
    {
        $message = sprintf(self::ERROR_MESSAGE, $propertyName);

        parent::__construct($message);
    }
}