<?php

namespace App\DTO;

use App\Attribute\EntityPropertyMap;
use DateTime;
use Symfony\Component\Uid\Uuid;

class ListingDto
{
    #[EntityPropertyMap(property_name: 'id')]
    private Uuid $id;

    #[EntityPropertyMap(property_name: 'createdAt')]
    private DateTime $createdAt;

    #[EntityPropertyMap(property_name: 'title')]
    private string $title;


    // SETTERS
    public function setId(Uuid $id): void
    {
        $this->id = $id;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    // GETTERS

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}