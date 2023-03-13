<?php

namespace App\DTO;

use DateTime;
use Symfony\Component\Uid\Uuid;
use App\Annotation\DataMapper;

class ListingResponseDto
{
    /**
     * @var Uuid
     * @DataMapper(entity_field="id")
     */
    private Uuid $id;

    /**
     * @var DateTime
     * @DataMapper(entity_field="createdAt")
     */
    private DateTime $createdAt;

    /**
     * @var string
     * @DataMapper(entity_field="title")
     */
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