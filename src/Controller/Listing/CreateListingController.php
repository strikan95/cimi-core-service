<?php

namespace App\Controller\Listing;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateListingController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/listings', name:'listing.get.with.id', methods: ['POST'])]
    public function create() : Response
    {
        return new Response();
    }
}