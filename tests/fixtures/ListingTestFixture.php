<?php

namespace App\Tests\fixtures;

use App\Entity\Listing;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ListingTestFixture extends AbstractFixture implements FixtureInterface
{
    public const FOO_LISTING_REFERENCE = 'foo-listing';
    public const BAR_LISTING_REFERENCE = 'bar-listing';


    public function load(ObjectManager $manager)
    {
        $fooListing = new Listing();
        $fooListing->setTitle('foo');
        $manager->persist($fooListing);

        $barListing = new Listing();
        $barListing->setTitle('bar');
        $manager->persist($barListing);

        $manager->flush();

        $this->addReference(self::FOO_LISTING_REFERENCE, $fooListing);
        $this->addReference(self::BAR_LISTING_REFERENCE, $barListing);
    }
}