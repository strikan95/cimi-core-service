<?php

namespace App\Tests\resources;

use Symfony\Component\Validator\Constraints as Assert;

class TestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max:128)]
    private string $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}