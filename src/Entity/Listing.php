<?php

namespace App\Entity;

use App\Repository\ListingRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ListingRepository::class)]
class Listing
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?UUid $id = null;

    #[ORM\Column(length: 128)]
    private ?string $title = null;

    #[ORM\Column(name: "createdAt", type: "datetime", nullable: true)]
    private DateTime|null $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }


    // GETTERS

    public function getId(): ?UUid
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }


    // SETTERS

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function __toString(): string
    {
        return "Post: [ id =" . $this->getId()
            . ", title=" . $this->getTitle()
            . ", createdAt=" . $this->getCreatedAt()?->getTimestamp()
            . "]";
    }
}
