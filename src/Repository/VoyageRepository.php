<?php

namespace App\Repository;

use App\Entity\Voyage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voyage>
 *
 * @method Voyage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voyage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voyage[]    findAll()
 * @method Voyage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoyageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voyage::class);
    }

    /**
     * Recherche simple (pour un composant de type SearchSite par exemple).
     *
     * @param string|null $query          Terme à rechercher dans l’objectif
     * @param int[]       $searchPlanetes Liste d’IDs de planètes filtrantes
     * @param int|null    $limit          Nombre max de résultats
     *
     * @return Voyage[]
     */
    public function findBySearch(
        ?string $query,
        array $searchPlanetes = [],
        ?int $limit = null
    ): array {
        $qb = $this->findBySearchQueryBuilder($query, $searchPlanetes);

        if (null !== $limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Construit un QueryBuilder paginable et triable.
     *
     * @param string|null $query          Terme à chercher dans l’objectif
     * @param int[]       $searchPlanetes Liste d’IDs de planètes filtrantes
     * @param string|null $sort           Champ de tri (`objectif` ou `depart`)
     * @param string      $direction      `ASC` ou `DESC`
     */
    public function findBySearchQueryBuilder(
        ?string $query,
        array $searchPlanetes = [],
        ?string $sort = null,
        string $direction = 'DESC'
    ): QueryBuilder {
        $qb = $this->createQueryBuilder('v')
            ->leftJoin('v.planete', 'p')
            ->addSelect('p');

        if (!empty($query)) {
            $qb->andWhere('v.objectif LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }

        if (!empty($searchPlanetes)) {
            $qb->andWhere('p.id IN (:planetes)')
                ->setParameter('planetes', $searchPlanetes);
        }

        // Seuls ces champs sont autorisés au tri
        $validSorts = ['objectif', 'depart'];
        $sort = in_array($sort, $validSorts, true) ? $sort : 'depart';
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

        $qb->orderBy('v.' . $sort, $direction);

        return $qb;
    }
}
