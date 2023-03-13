<?php

namespace App\Tests;

use App\Entity\Listing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class BaseApiTestCase extends WebTestCase
{
    /** @var null|EntityManagerInterface*/
    protected null|EntityManagerInterface $entityManager;
    protected static KernelBrowser $client;

    protected function setUp() : void
    {
        self::$client = static::createClient();

        static::$kernel = self::bootKernel();
        DatabasePrimer::prime(static::$kernel);
        $this->entityManager = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

    /** @test */
    public function an_entity_can_be_stored_in_database() : void
    {
        $entity = new Listing();
        $entity->setTitle('Test title');

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $record = $this->entityManager->find(Listing::class, $entity->getId());

        $this->assertNotNull($record);
        $this->assertEquals($entity->getCreatedAt(), $record->getCreatedAt());
    }
}