<?php

namespace App\Repository;

use App\Entity\Yesorno;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Yesorno|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yesorno|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yesorno[]    findAll()
 * @method Yesorno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YesornoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yesorno::class);
    }

    // /**
    //  * @return Yesorno[] Returns an array of Yesorno objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yesorno
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
