<?php

namespace App\Repository;

use App\Entity\ImageAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ImageAdmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageAdmin[]    findAll()
 * @method ImageAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageAdminRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImageAdmin::class);
    }
}
