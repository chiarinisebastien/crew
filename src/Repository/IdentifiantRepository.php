<?php

namespace App\Repository;

use App\Entity\Identifiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Identifiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Identifiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Identifiant[]    findAll()
 * @method Identifiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentifiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Identifiant::class);
    }

    // /**
    //  * @return Identifiant[] Returns an array of Identifiant objects
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
    public function findOneBySomeField($value): ?Identifiant
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
