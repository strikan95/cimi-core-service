<?php

namespace App\Controller\Listing;

use App\DTO\ListingResponseDto;
use App\Repository\ListingRepository;
use App\Service\DTOSerializer;
use App\Service\EntityDtoMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Uid\Uuid;

class GetListingWithIdController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly ListingRepository $repository
    )
    {
    }

    #[Route('/listings/{uuid}', name:'listing.get.with.id')]
    public function getWithId(Uuid $uuid) : Response
    {
        $listing = $this->repository->findOneBy(
            ["id" => $uuid]
        );

        if(!$listing)
        {
            throw $this->createNotFoundException("Listing not found.");
        }

        $responseContent = $this->serializer->serialize(
            EntityDtoMapper::map($listing, ListingResponseDto::class),
            'json'
        );

        return new Response(
            $responseContent,
            200,
            ["Content-Type" => "application/json"]
        );
    }
}