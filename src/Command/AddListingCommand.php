<?php

namespace App\Command;

use App\Entity\Listing;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:add:listing',
    description: 'Add a short description for your command',
)]
class AddListingCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('title', InputArgument::OPTIONAL, 'Argument description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $title = $input->getArgument('title');

        if ($title) {
            $io->note(sprintf('You passed an argument: %s', $title));
        }

        $listing = new Listing();
        $listing->setTitle($title);

        $this->entityManager->persist($listing);
        $this->entityManager->flush();
        //$this->repository->save($listing, true);

        $io->success('Listing Created: ' . $listing);

        return Command::SUCCESS;
    }
}
