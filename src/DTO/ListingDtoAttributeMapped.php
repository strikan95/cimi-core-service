<?php

namespace App\DTO;

use App\Attribute\AttributeMap;
use DateTime;
use Symfony\Component\Uid\Uuid;

class ListingDtoAttributeMapped
{
    #[AttributeMap(entity_attribute_name: 'id')]
    private Uuid $id;

    #[AttributeMap(entity_attribute_name: 'createdAt')]
    private DateTime $createdAt;

    #[AttributeMap(entity_attribute_name: 'title')]
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
