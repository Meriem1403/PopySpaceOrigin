<?php

namespace App\Controller;

use App\Repository\VoyageRepository;
use App\Repository\PlaneteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function accueil(VoyageRepository $voyageRepository, PlaneteRepository $planeteRepository): Response
    {
        return $this->render('main/accueil.html.twig', [
            'voyages' => $voyageRepository->findBy([], ['depart' => 'DESC']),
            'planetes' => $planeteRepository->findAll(),
        ]);
    }
}
