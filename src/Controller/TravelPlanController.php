<?php

namespace App\Controller;

use App\Entity\TravelPlan;
use App\Form\TravelPlanType;
use App\Repository\TravelPlanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/travelplan')]
class TravelPlanController extends AbstractController
{
    #[Route('/', name: 'app_travel_plan_index', methods: ['GET'])]
    public function index(TravelPlanRepository $travelPlanRepository): Response
    {
        return $this->render('travel_plan/index.html.twig', [
            'travel_plans' => $travelPlanRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_travel_plan_new', methods: ['GET', 'POST'])]
    public function new (Request $request, EntityManagerInterface $entityManager): Response
    {
        $travelPlan = new TravelPlan();
        $form = $this->createForm(TravelPlanType::class, $travelPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($travelPlan);
            $entityManager->flush();

            return $this->redirectToRoute('app_travel_plan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('travel_plan/new.html.twig', [
            'travel_plan' => $travelPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_travel_plan_show', methods: ['GET'])]
    public function show(TravelPlan $travelPlan): Response
    {
        return $this->render('travel_plan/show.html.twig', [
            'travel_plan' => $travelPlan,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_travel_plan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TravelPlan $travelPlan, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TravelPlanType::class, $travelPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_travel_plan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('travel_plan/edit.html.twig', [
            'travel_plan' => $travelPlan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_travel_plan_delete', methods: ['POST'])]
    public function delete(Request $request, TravelPlan $travelPlan, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $travelPlan->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($travelPlan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_travel_plan_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, EntityManagerInterface $entityManager): Response
    {
        $searchTerm = $request->query->get('search', '');

        $countries = [];
        if ($searchTerm) {
            $countries = $entityManager->getRepository(TravelPlan::class)->findBy([
                'country' => $searchTerm,
            ]);
        }

        return $this->render('travel_plan/index.html.twig', [
            'countries' => $countries,
        ]);
    }
}
