<?php

namespace App\Controller;

use App\Entity\TravelPlan;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $searchTerm = $request->query->get('search', '');

        $travel_plans = [];
        if ($searchTerm) {
            $travel_plans = $entityManager->getRepository(TravelPlan::class)->findBy([
                'country' => $searchTerm,
            ]);
        }

        return $this->render('search/index.html.twig', [
            'travel_plans' => $travel_plans,
        ]);
    }
}
