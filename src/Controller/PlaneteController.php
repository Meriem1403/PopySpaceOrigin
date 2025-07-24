<?php

namespace App\Controller;

use App\Repository\PlaneteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlaneteController extends AbstractController
{
    #[Route('/', name: 'app_planete')]
    public function index(PlaneteRepository $planeteRepository): Response
    {
        return $this->render('planete/index.html.twig', [
            'planetes' => $planeteRepository->findAll(),
        ]);
    }
}
