<?php

namespace App\Repository;

use App\Entity\InscriptionSemestre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InscriptionSemestre|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionSemestre|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionSemestre[]    findAll()
 * @method InscriptionSemestre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionSemestreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionSemestre::class);
    }

    // /**
    //  * @return InscriptionSemestre[] Returns an array of InscriptionSemestre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InscriptionSemestre
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
