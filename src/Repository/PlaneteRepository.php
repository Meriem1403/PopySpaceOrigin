<?php

namespace App\Repository;

use App\Entity\Planete;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Planete>
 *
 * @method Planete|null find($id, $lockMode = null, $lockVersion = null)
 * @method Planete|null findOneBy(array $criteria, array $orderBy = null)
 * @method Planete[]    findAll()
 * @method Planete[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaneteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Planete::class);
    }

    // Exemple : à activer si besoin
    // public function findByNom(string $nom): array
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.name LIKE :nom')
    //         ->setParameter('nom', '%' . $nom . '%')
    //         ->orderBy('p.id', 'ASC')
    //         ->getQuery()
    //         ->getResult();
    // }
}
