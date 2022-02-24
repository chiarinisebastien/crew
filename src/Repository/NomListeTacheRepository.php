<?php

namespace App\Repository;

use App\Entity\NomListeTache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NomListeTache|null find($id, $lockMode = null, $lockVersion = null)
 * @method NomListeTache|null findOneBy(array $criteria, array $orderBy = null)
 * @method NomListeTache[]    findAll()
 * @method NomListeTache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NomListeTacheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomListeTache::class);
    }

    // /**
    //  * @return NomListeTache[] Returns an array of NomListeTache objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NomListeTache
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
