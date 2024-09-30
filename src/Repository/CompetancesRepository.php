<?php

namespace App\Repository;

use App\Entity\Competances;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Competances>
 *
 * @method Competances|null find($id, $lockMode = null, $lockVersion = null)
 * @method Competances|null findOneBy(array $criteria, array $orderBy = null)
 * @method Competances[]    findAll()
 * @method Competances[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetancesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Competances::class);
    }

    //    /**
    //     * @return Competances[] Returns an array of Competances objects
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

    //    public function findOneBySomeField($value): ?Competances
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
