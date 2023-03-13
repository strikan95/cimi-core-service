<?php

namespace App\Tests\integration;

use App\Entity\Listing;
use App\Service\DTOSerializer;
use App\Tests\FixtureAwareTestCase;
use App\Tests\fixtures\ListingTestFixture;

class ListingGetWithIdControllerTest extends FixtureAwareTestCase
{
    private array $fixtureReferences;

    /** @test */
    public function test() : void
    {
        $entities = $this->fixtureReferences[Listing::class];

        /** @var Listing $foo */
        $foo = $entities[ListingTestFixture::FOO_LISTING_REFERENCE];

        $request = $this->client
            ->request(
                'GET',
                sprintf('http://localhost:8080/listings/%s', $foo->getId())
            );

        $json = $this->client->getResponse()->getContent();
        $data = json_decode($json, true);

        $this->assertEquals($foo->getId(), $data['id']);
        $this->assertEquals($foo->getTitle(), $data['title']);
        $this->assertEquals(
            $foo->getCreatedAt()->format(DTOSerializer::getDateTimeFormat()),
            $data['created_at']);

        dump($data);
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