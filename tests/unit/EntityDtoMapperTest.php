<?php

namespace App\Tests\unit;

use App\DTO\ListingDtoAttributeMapped;
use App\DTO\ListingResponseDto;
use App\Entity\Listing;
use App\Service\EntityDtoMapper;
use App\Tests\FixtureAwareTestCase;
use App\Tests\fixtures\ListingTestFixture;
use PHPUnit\Framework\TestCase;

class EntityDtoMapperTest extends FixtureAwareTestCase
{
    private array $fixtureReferences;

    /** @test */
    public function test2()
    {
        $entity = $this->fixtureReferences[Listing::class][ListingTestFixture::FOO_LISTING_REFERENCE];

        $dto = EntityDtoMapper::map_test($entity, ListingDtoAttributeMapped::class);

        dd($dto);
    }

    /** @test */
    public function test()
    {
        $entity = $this->fixtureReferences[Listing::class][ListingTestFixture::FOO_LISTING_REFERENCE];

        $dto = EntityDtoMapper::map($entity, ListingResponseDto::class);

        $this->assertNotNull($dto);
        $this->assertEquals($entity->getTitle(), $dto->getTitle());
        $this->assertEquals($entity->getId(), $dto->getId());
        $this->assertEquals($entity->getCreatedAt(), $dto->getCreatedAt());
    }

    protected function loadFixtures() : void
    {
        $this->loader->addFixture(new ListingTestFixture());
        $this->executor->execute($this->loader->getFixtures());

        $this->fixtureReferences = $this->executor
            ->getReferenceRepository()
            ->getReferencesByClass();
    }
}