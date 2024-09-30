<?php

namespace App\Repository;

use App\Entity\InscriptionIntervenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InscriptionIntervenant>
 *
 * @method InscriptionIntervenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionIntervenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionIntervenant[]    findAll()
 * @method InscriptionIntervenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionIntervenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionIntervenant::class);
    }

    //    /**
    //     * @return InscriptionIntervenant[] Returns an array of InscriptionIntervenant objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?InscriptionIntervenant
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
