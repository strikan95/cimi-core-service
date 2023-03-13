<?php

namespace App\Tests\unit;

use App\DTO\ListingDto;
use App\Entity\Listing;
use App\Service\EntityDtoMapper;
use App\Tests\FixtureAwareTestCase;
use App\Tests\fixtures\ListingTestFixture;
use ReflectionException;

class EntityDtoMapperTest extends FixtureAwareTestCase
{
    private array $fixtureReferences;

    /** @test
     * @throws ReflectionException
     */
    public function test()
    {
        $entity = $this->fixtureReferences[Listing::class][ListingTestFixture::FOO_LISTING_REFERENCE];

        $dto = EntityDtoMapper::map($entity, ListingDto::class);

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