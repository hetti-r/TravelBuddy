<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SinglePageController extends AbstractController
{
    #[Route('/single/page', name: 'app_single_page')]
    public function index(): Response
    {
        return $this->render('single_page/index.html.twig', [
            'controller_name' => 'SinglePageController',
        ]);
    }
}
