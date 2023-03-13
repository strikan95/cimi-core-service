<?php

namespace App\Tests;

use App\Kernel;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FixtureAwareTestCase extends WebTestCase
{
    protected ?EntityManagerInterface $entityManager;

    protected static ?KernelBrowser $staticClient;
    protected ?KernelBrowser $client;

    protected ?ORMExecutor $executor;
    protected ?Loader $loader;

    protected function setUp() : void
    {
        self::$staticClient = static::createClient();
        $this->client = self::$staticClient;

        //self::$kernel = self::bootKernel();

        DatabasePrimer::prime(self::$kernel);
        $this->entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();

        $this->loader = new Loader();
        $this->executor = new ORMExecutor($this->entityManager, new ORMPurger());

        $this->loadFixtures();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
        $this->client = null;
        $this->loader = null;
        $this->executor = null;
    }

    abstract protected function loadFixtures();
}