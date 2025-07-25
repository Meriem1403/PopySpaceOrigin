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

    public function findBySearchQueryBuilder(
        ?string $query,
        array $searchPlanets = [],
        ?string $sort = null,
        string $direction = 'DESC'
    ): QueryBuilder {
        $qb = $this->createQueryBuilder('v')
            ->leftJoin('v.planet', 'p')
            ->addSelect('p');

        if ($query !== null && $query !== '') {
            $qb->andWhere('v.purpose LIKE :query')
                ->setParameter('query', '%' . $query . '%');
        }

        if (!empty($searchPlanets)) {
            $qb->andWhere('p.id IN (:planets)')
                ->setParameter('planets', $searchPlanets);
        }

        $validSorts = ['purpose', 'leaveAt'];
        if (in_array($sort, $validSorts, true)) {
            $qb->orderBy('v.' . $sort, strtoupper($direction) === 'DESC' ? 'DESC' : 'ASC');
        } else {
            $qb->orderBy('v.leaveAt', 'ASC');
        }

        return $qb;
    }
}
