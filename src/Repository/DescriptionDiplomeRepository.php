<?php

namespace App\Repository;

use App\Entity\DescriptionDiplome;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DescriptionDiplome|null find($id, $lockMode = null, $lockVersion = null)
 * @method DescriptionDiplome|null findOneBy(array $criteria, array $orderBy = null)
 * @method DescriptionDiplome[]    findAll()
 * @method DescriptionDiplome[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptionDiplomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DescriptionDiplome::class);
    }

    // /**
    //  * @return DescriptionDiplome[] Returns an array of DescriptionDiplome objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DescriptionDiplome
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
