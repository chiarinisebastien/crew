<?php

namespace App\Repository;

use App\Entity\AdminDeparture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdminDeparture|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminDeparture|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminDeparture[]    findAll()
 * @method AdminDeparture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminDepartureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminDeparture::class);
    }

    // /**
    //  * @return AdminDeparture[] Returns an array of AdminDeparture objects
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
    public function findOneBySomeField($value): ?AdminDeparture
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
