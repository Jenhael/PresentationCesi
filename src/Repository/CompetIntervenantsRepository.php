<?php

namespace App\Repository;

use App\Entity\CompetIntervenants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompetIntervenants>
 *
 * @method CompetIntervenants|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetIntervenants|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetIntervenants[]    findAll()
 * @method CompetIntervenants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetIntervenantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetIntervenants::class);
    }

    //    /**
    //     * @return CompetIntervenants[] Returns an array of CompetIntervenants objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CompetIntervenants
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
