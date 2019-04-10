<?php

namespace App\Repository;

use App\Entity\Comment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;



class CommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function countComments(): string
    {
        return $this->createQueryBuilder('c')
            ->select('COUNT(c)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    /**
     * @param $rate
     * @return Comment[]
     */
    public function findAllGreaterThanRate($rate): array
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('c')
            ->andWhere('c.rate > :rate')
            ->setParameter('rate', $rate)
            ->orderBy('c.rate', 'ASC')
            ->getQuery();

        return $qb->execute();


    }

}
