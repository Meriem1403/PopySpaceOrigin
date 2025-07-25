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
     * Recherche simple utilisée dans le composant SearchSite
     *
     * @return Voyage[]
     */
    public function findBySearch(
        string $query,
        array $searchPlanets = [],
        int $limit = null
    ): array {
        $qb = $this->findBySearchQueryBuilder($query, $searchPlanets);

        if ($limit !== null) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * Construit une requête de recherche paginable avec tri
     */
    public function findBySearchQueryBuilder(
        ?string $query,
        array $searchPlanets = [],
        ?string $sort = null,
        string $direction = 'DESC'
    ): QueryBuilder {
        $qb = $this->createQueryBuilder('v')
            ->leftJoin('v.planet', 'p')
            ->addSelect('p');

        if (!empty($query)) {
            $qb->andWhere('v.purpose LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }

        if (!empty($searchPlanets)) {
            $qb->andWhere('p.id IN (:planets)')
                ->setParameter('planets', $searchPlanets);
        }

        $validSorts = ['purpose', 'leaveAt'];
        $sort = in_array($sort, $validSorts, true) ? $sort : 'leaveAt';
        $direction = strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC';

        $qb->orderBy('v.' . $sort, $direction);

        return $qb;
    }
}
