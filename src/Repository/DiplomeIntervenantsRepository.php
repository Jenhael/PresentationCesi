<?php

namespace App\Repository;

use App\Entity\DiplomeIntervenants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DiplomeIntervenants>
 *
 * @method DiplomeIntervenants|null find($id, $lockMode = null, $lockVersion = null)
 * @method DiplomeIntervenants|null findOneBy(array $criteria, array $orderBy = null)
 * @method DiplomeIntervenants[]    findAll()
 * @method DiplomeIntervenants[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiplomeIntervenantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DiplomeIntervenants::class);
    }

    //    /**
    //     * @return DiplomeIntervenants[] Returns an array of DiplomeIntervenants objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DiplomeIntervenants
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
