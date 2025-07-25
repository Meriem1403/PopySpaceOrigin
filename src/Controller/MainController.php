<?php

namespace App\Controller;

use App\Repository\PlaneteRepository;
use App\Repository\VoyageRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use const FILTER_VALIDATE_INT;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        VoyageRepository $voyageRepository,
        PlaneteRepository $planeteRepository,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $sort = 'depart',
        #[MapQueryParameter] string $sortDirection = 'ASC',
        #[MapQueryParameter] ?string $query = null,
        #[MapQueryParameter('planetes', FILTER_VALIDATE_INT)] array $searchPlanetes = [],
    ): Response {
        // Seuls ces deux tris sont autorisés : "objectif" et "depart"
        $validSorts = ['objectif', 'depart'];
        $sort = in_array($sort, $validSorts, true) ? $sort : 'depart';
        $direction = strtoupper($sortDirection) === 'DESC' ? 'DESC' : 'ASC';

        // Construction du Pagerfanta
        $qb = $voyageRepository->findBySearchQueryBuilder($query, $searchPlanetes, $sort, $direction);
        $pager = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($qb),
            $page,
            10
        );

        return $this->render('main/homepage.html.twig', [
            'voyages'        => $pager,
            'planetes'       => $planeteRepository->findAll(),
            'searchPlanetes' => $searchPlanetes,
            'sort'           => $sort,
            'sortDirection'  => $direction,
        ]);
    }
}
