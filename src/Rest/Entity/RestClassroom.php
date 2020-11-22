<?php

declare(strict_types=1);

namespace App\Rest\Entity;

use DateTimeInterface;

class RestClassroom
{
    private const DATE_FORMAT = 'd.m.Y';

    private int $id;

    private ?string $name = null;
    
    private ?string $date_created = null;

    private ?int $is_active = null;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDateCreated(DateTimeInterface $dateCreated): void
    {
        $this->date_created = $dateCreated->format(self::DATE_FORMAT);
    }

    public function getDateCreated(): ?string
    {
        return $this->date_created;
    }

    public function setIsActive(int $active): void
    {
        $this->is_active = $active;
    }

    public function isActive(): ?int
    {
        return $this->is_active;
    }
}