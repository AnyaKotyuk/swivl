<?php

namespace App\Rest\Service;

use App\Exception\EmptyPropertyException;
use App\Rest\Entity\RestClassroom;

class ClassroomValidator
{
    public function validate(RestClassroom $restClassroom): void
    {
        if (!$restClassroom->getName()) {
            throw new EmptyPropertyException('Name');
        }

        if (!$restClassroom->getDateCreated()) {
            throw new EmptyPropertyException('DateCreated');
        }

        if (!$restClassroom->isActive()) {
            throw new EmptyPropertyException('isActive');
        }
    }
}