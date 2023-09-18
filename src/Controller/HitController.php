<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\StatsStorage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HitController extends AbstractController
{
    private StatsStorage $statsStorage;

    public function __construct(StatsStorage $statsStorage)
    {
        $this->statsStorage = $statsStorage;
    }

    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function stats(Request $request): Response
    {
        return new JsonResponse($this->statsStorage->getHits());
    }

    #[Route('/hit', name: 'hit', methods: ['GET'])]
    public function hit(Request $request): Response
    {
        $country = $request->get('country');

        if ($country === null) {
            return new Response('Parameter "country" is required', Response::HTTP_BAD_REQUEST);
        }

        $this->statsStorage->hit(strtoupper($country));

        return new Response(null, Response::HTTP_ACCEPTED);
    }
}
