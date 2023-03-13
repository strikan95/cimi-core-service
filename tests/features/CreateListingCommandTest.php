<?php

namespace App\tests\features;

use App\Entity\Listing;
use App\Tests\BaseApiTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CreateListingCommandTest extends BaseApiTestCase
{
    /** @test */
    public function a_listing_is_successfully_created_with_add_listing_command_test() : void
    {
        $entityTitle = 'Test Title';

        $application = new Application(static::$kernel);

        $command = $application->find('app:add:listing');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            // pass arguments to the helper
            'title' => $entityTitle,

            // prefix the key with two dashes when passing options,
            // e.g: '--some-option' => 'option_value',
            // use brackets for testing array value,
            // e.g: '--some-option' => ['option_value'],
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        preg_match('/(?<=id =).{36}/', $output, $id);

        $record = $this->entityManager->find(Listing::class, $id[0]);

        $this->assertNotNull($record);
        $this->assertEquals($entityTitle, $record->getTitle());

        // the output of the command in the console
        //$output = $commandTester->getDisplay();
        //$this->assertStringContainsString('Listing Created: ', $output);
    }
}