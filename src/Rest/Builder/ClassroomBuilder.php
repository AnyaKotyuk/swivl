<?php

declare(strict_types=1);

namespace App\Rest\Builder;

use App\Entity\Classroom;
use App\Rest\Entity\RestClassroom;
use DateTime;

class ClassroomBuilder
{
    public function createRestClassroom(Classroom $classroom): RestClassroom
    {
        $restClassroom = new RestClassroom();

        $restClassroom->setId($classroom->getId());
        $restClassroom->setName($classroom->getName());
        $restClassroom->setDateCreated($classroom->getDateCreated());
        $restClassroom->setIsActive($classroom->getActive());

        return $restClassroom;
    }

    public function createClassroom(RestClassroom $restClassroom): Classroom
    {
        $classroom = new Classroom();

        $classroom->setName($restClassroom->getName());
        $classroom->setDateCreated(new DateTime($restClassroom->getDateCreated()));
        $classroom->setActive($restClassroom->isActive());

        return $classroom;
    }

    public function updateClassroom(RestClassroom $restClassroom, Classroom $classroom): void
    {
        $classroom->setName($restClassroom->getName());
        $classroom->setDateCreated(new DateTime($restClassroom->getDateCreated()));
        $classroom->setActive($restClassroom->isActive());
    }
}