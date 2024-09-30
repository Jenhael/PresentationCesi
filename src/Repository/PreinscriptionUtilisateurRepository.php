<?php

namespace App\Repository;

use App\Entity\PreinscriptionUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PreinscriptionUtilisateur>
 *
 * @method PreinscriptionUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreinscriptionUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreinscriptionUtilisateur[]    findAll()
 * @method PreinscriptionUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreinscriptionUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreinscriptionUtilisateur::class);
    }

    //    /**
    //     * @return PreinscriptionUtilisateur[] Returns an array of PreinscriptionUtilisateur objects
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

    //    public function findOneBySomeField($value): ?PreinscriptionUtilisateur
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
