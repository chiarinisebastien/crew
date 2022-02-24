<?php

namespace App\Repository;

use App\Entity\Intervention;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Intervention|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intervention|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intervention[]    findAll()
 * @method Intervention[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterventionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intervention::class);
    }

    // /**
    //  * @return Intervention[] Returns an array of Intervention objects
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
    public function findOneBySomeField($value): ?Intervention
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * @return Service[]
     */
    public function findByService($helper,$year,$mois): array
    {        
        $qb = $this->createQueryBuilder('a')
            ->join('a.service', 's')
            ->addselect('sum(TIMESTAMPDIFF(MINUTE,a.createdAt,a.clotureAt)) AS diff')
            ->addselect('s.title')
            ->andWhere('a.user = :helper')
            ->setParameter('helper', $helper);

            
            if ($year > 2020 ) {
                $qb->andWhere('YEAR(a.createdAt) = :year')
                ->setParameter('year', $year);
            }

            if ($mois != 13 ) {
                $qb->andWhere('MONTH(a.createdAt) = :mois')
                ->setParameter('mois', $mois);
            }

            $qb ->orderBy('diff', 'DESC')
                ->groupBy('s.id');

            return $qb->getQuery()->getResult();
        ;
    }

    public function findBigUser($helper, $year,$mois): array
    {       
        $qb = $this->createQueryBuilder('a')
            ->join('a.agent', 's')
            ->addselect('sum(TIMESTAMPDIFF(MINUTE,a.createdAt,a.clotureAt)) AS diff')
            ->addselect('s.lastname')
            ->addselect('s.firstname')            
            ->andWhere('a.user = :helper')
            ->setParameter('helper', $helper);


            if ($year > 2020 ) {
                $qb->andWhere('YEAR(a.createdAt) = :year')
                ->setParameter('year', $year);
            }

            if ($mois != 13 ) {
                $qb->andWhere('MONTH(a.createdAt) = :mois')
                ->setParameter('mois', $mois);
            }

            $qb ->orderBy('diff', 'DESC')
                ->groupBy('s.id');

            return $qb->getQuery()->getResult();
        ;
    }
    
    public function findNbService($helper, $year,$mois): array
    {        
        $qb = $this->createQueryBuilder('a')
            ->join('a.service', 's')
            ->addselect('COUNT(a.origine) AS diff')
            ->addselect('s.title')
            ->andWhere('a.user = :helper')
            ->andWhere('a.origine = 2')
            ->setParameter('helper', $helper);

            if ($year > 2020 ) {
                $qb->andWhere('YEAR(a.createdAt) = :year')
                ->setParameter('year', $year);
            }

            if ($mois != 13 ) {
                $qb->andWhere('MONTH(a.createdAt) = :mois')
                ->setParameter('mois', $mois);
            }
            $qb ->orderBy('diff', 'DESC')
                ->groupBy('s.id');

            return $qb->getQuery()->getResult();
        ;
    }
    
    public function findInterByMonth($helper, $year,$mois): array
    {        
        $qb = $this->createQueryBuilder('a')
            ->join('a.service', 's')
            ->addselect('COUNT(a.origine) AS diff')
            ->addselect('MONTH(a.createdAt) AS gbMonth')
            ->andWhere('a.user = :helper')
            ->andWhere('a.origine = 2')
            ->setParameter('helper', $helper);
            
            if ($year > 2020 ) {
                $qb->andWhere('YEAR(a.createdAt) = :year')
                ->setParameter('year', $year);
            }

            if ($mois != 13 ) {
                $qb->andWhere('MONTH(a.createdAt) = :mois')
                ->setParameter('mois', $mois);
            }
            $qb ->orderBy('gbMonth', 'ASC')
                ->groupBy('gbMonth');

            return $qb->getQuery()->getResult();
        ;
    }
}
