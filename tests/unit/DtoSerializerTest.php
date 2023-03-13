<?php

namespace App\Tests\unit;

use App\Service\DtoSerializer;
use DateTime;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class DtoSerializerTest extends TestCase
{
    /** @test */
    public function camel_case_to_snake_case_works_as_expected_test() : void
    {
        // Set up
        // Create object with property name in camel case
        $obj = new \stdClass();
        $obj->objectPropertyInCamelCase = 'some value';

        // Do something
        // Get serializer
        $serializer = new DtoSerializer();
        $jsonDecoded = json_decode($serializer->serialize($obj, 'json'), true);

        // Assert that property is in snake case
        self::assertArrayHasKey('object_property_in_camel_case', $jsonDecoded);
    }

    /** @test */
    public function uuid_serializes_to_string_correctly_test() : void
    {
        $uuidString = 'd9e7a184-5d5b-11ea-a62a-3499710062d0';
        $uuidObj = Uuid::fromString($uuidString);

            // Get serializer
        $serializer = new DtoSerializer();

        // Do Something
        // Serialize datetime object
        $jsonData = $serializer->serialize($uuidObj, 'json');

        // decode
        $jsonDecoded = json_decode(
            $jsonData,
            true
        );

        $this->assertNotNull($jsonDecoded);
        $this->assertIsString($jsonDecoded);
        $this->assertEquals($uuidString, $jsonDecoded);
    }

    /** @test */
    public function datetime_serializes_to_string_correctly_test() : void
    {
        $dateTimeString = '2023-05-06';
        $dateTimeObj = DateTime::createFromFormat('Y-m-d', $dateTimeString);

        // Get serializer
        $serializer = new DtoSerializer();

        // Do Something
        // Serialize datetime object
        $jsonData = $serializer->serialize($dateTimeObj, 'json');

        // decode
        $jsonDecoded = json_decode(
            $jsonData,
            true
        );

        $this->assertNotNull($jsonDecoded);
        $this->assertIsString($jsonDecoded);
        $this->assertEquals($dateTimeString, $jsonDecoded);
    }
}