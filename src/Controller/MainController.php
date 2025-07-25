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
        PlaneteRepository $planetRepository,
        #[MapQueryParameter] int $page = 1,
        #[MapQueryParameter] string $sort = 'leaveAt',
        #[MapQueryParameter] string $sortDirection = 'ASC',
        #[MapQueryParameter] ?string $query = null,
        #[MapQueryParameter('planets', FILTER_VALIDATE_INT)] array $searchPlanets = [],
    ): Response {
        $validSorts = ['purpose', 'leaveAt'];
        $sort = in_array($sort, $validSorts, true) ? $sort : 'leaveAt';

        // ⚠️ À implémenter dans VoyageRepository
        $queryBuilder = $voyageRepository->findBySearchQueryBuilder($query, $searchPlanets, $sort, $sortDirection);

        $pager = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($queryBuilder),
            $page,
            10
        );

        return $this->render('main/homepage.html.twig', [
            'voyages' => $pager,
            'planets' => $planetRepository->findAll(),
            'searchPlanets' => $searchPlanets,
            'sort' => $sort,
            'sortDirection' => $sortDirection,
        ]);
    }
}
