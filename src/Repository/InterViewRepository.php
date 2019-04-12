<?php
/**
 * Created by PhpStorm.
 * User: Surface
 * Date: 31/03/2019
 * Time: 21:28
 */


namespace App\Repository;
use App\Entity\InterView;
use App\Entity\ImageAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InterView|null find($id, $lockMode = null, $lockVersion = null)
 * @method InterView|null findOneBy(array $criteria, array $orderBy = null)
 * @method InterView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterViewRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImageAdmin::class);
    }
    /**
     * List all object with paginator.
     */
    public function paginator(int $page, int $maxResults): Paginator
    {
        $qb = $this->createQueryBuilder('p');

        $qb
            ->setFirstResult(($page - 1) * $maxResults)
            ->setMaxResults($maxResults)
            ->orderBy('p.createAt', 'DESC');

        return new Paginator($qb);
    }

    public function countInterViews(): string
    {
        return $this->createQueryBuilder('i')
            ->select('COUNT(i)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function saveNewInterView(InterView $interView): void
    {
        $this->_em->persist($interView);
        $this->_em->flush();
    }
    public function saveExistingInterView(): void
    {
        try {
            $this->_em->flush();
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param InterView $interView
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(InterView $interView): void
    {
        try {
            $this->_em->remove($interView);
        } catch (ORMException $e) {
        }
        $this->_em->flush();
    }
    public function findAll()
    {
        return $this->createQueryBuilder('i')
            ->where('i.deletedAt = 0')
            ->getQuery()
            ->getResult();
    }
}