<?php

namespace App\Repository;

use App\Entity\ResponsableNiveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResponsableNiveau|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponsableNiveau|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponsableNiveau[]    findAll()
 * @method ResponsableNiveau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableNiveauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsableNiveau::class);
    }

    // /**
    //  * @return ResponsableNiveau[] Returns an array of ResponsableNiveau objects
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
    public function findOneBySomeField($value): ?ResponsableNiveau
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
