<?php

namespace App\Repository;

use App\Entity\InterView;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InterView|null find($id, $lockMode = null, $lockVersion = null)
 * @method InterView|null findOneBy(array $criteria, array $orderBy = null)
 * @method InterView[]    findAll()
 * @method InterView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterViewRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InterView::class);
    }

    // /**
    //  * @return InterView[] Returns an array of InterView objects
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
    public function findOneBySomeField($value): ?InterView
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
