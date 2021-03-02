<?php

namespace App\Repository;

use App\Entity\UserSemestre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserSemestre|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSemestre|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSemestre[]    findAll()
 * @method UserSemestre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSemestreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSemestre::class);
    }

    // /**
    //  * @return UserSemestre[] Returns an array of UserSemestre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserSemestre
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
