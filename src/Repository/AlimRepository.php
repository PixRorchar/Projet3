<?php

namespace App\Repository;

use App\Entity\Alim;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Alim|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alim|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alim[]    findAll()
 * @method Alim[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Alim::class);
    }

    // /**
    //  * @return Alim[] Returns an array of Alim objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alim
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
