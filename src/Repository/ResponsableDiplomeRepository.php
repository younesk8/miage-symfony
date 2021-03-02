<?php

namespace App\Repository;

use App\Entity\ResponsableDiplome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResponsableDiplome|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponsableDiplome|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponsableDiplome[]    findAll()
 * @method ResponsableDiplome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableDiplomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsableDiplome::class);
    }

    // /**
    //  * @return ResponsableDiplome[] Returns an array of ResponsableDiplome objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResponsableDiplome
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
