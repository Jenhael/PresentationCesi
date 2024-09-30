<?php

namespace App\Repository;

use App\Entity\PositionIntervenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PositionIntervenant>
 *
 * @method PositionIntervenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method PositionIntervenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method PositionIntervenant[]    findAll()
 * @method PositionIntervenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PositionIntervenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PositionIntervenant::class);
    }

    //    /**
    //     * @return PositionIntervenant[] Returns an array of PositionIntervenant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PositionIntervenant
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
