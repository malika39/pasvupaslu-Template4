<?php
/**
 * Created by PhpStorm.
 * User: Surface
 * Date: 31/03/2019
 * Time: 21:28
 */


namespace App\Repository;
use App\Entity\Editeur;
use App\Entity\ImageAdmin;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Editeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Editeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Editeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EditeurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Editeur::class);
    }
    /**
     * List all object with paginator.
     */
    public function paginator(int $page, int $maxResults): Paginator
    {
        $qb = $this->createQueryBuilder('e');

        $qb
            ->setFirstResult(($page - 1) * $maxResults)
            ->setMaxResults($maxResults)
            ->orderBy('e.createAt', 'DESC');

        return new Paginator($qb);
    }

    public function countEditeurs(): string
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->getQuery()
            ->getSingleScalarResult();
    }


    /**
     * @param Editeur $editeur
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function remove(Editeur $editeur): void
    {
        try {
            $this->_em->remove($editeur);
        } catch (ORMException $e) {
        }
        $this->_em->flush();
    }
    public function findAll()
      {
    return $this->createQueryBuilder('e')
        ->where('e.deletedAt = 0')
        ->getQuery()
        ->getResult();
       }
    public function findOneBySlug(string $slug): ?Editeur
    {
        return $this->createQueryBuilder('e')
            ->where('e.slug = :slug')
            ->andWhere('e.deletedAt = 0')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findDuplicateSlug(?int $id, string $slug): ?Editeur
    {
        $queryBuilder = $this->createQueryBuilder('e');
        $queryBuilder
            ->andWhere('e.deletedAt = 0');
        if ($id) {
            $queryBuilder
                ->andWhere('e.id != :id')
                ->setParameter('id', $id);
        }
        $queryBuilder->andWhere('e.slug = :slug OR e.slug LIKE :alt_with_suffix')
            ->setParameter('slug', $slug)
            ->setParameter('alt_with_suffix', $slug . '-%');

        return $queryBuilder
            ->orderBy('e.slug', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findLatest(int $maxResults): array
    {
        return $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.deletedAt = 0')
            ->orderBy('e.dateCreated', 'DESC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
    }
    public function findAllWithDeleted()
    {
        return $this->createQueryBuilder('e')
            ->getQuery()
            ->getResult();
    }
    public function search(?string $query, int $firstResult = 0, int $maxResults = 10)
    {
        $query = $this->createQueryBuilder('e')
            ->where('e.name LIKE :query')
            ->andWhere('e.deletedAt = 0')
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults)
            ->setParameter('query', '%'.addcslashes($query, '%_').'%');

        return new Paginator($query);
    }
    public function getPaginated(int $firstResult = 0, int $maxResults = 10)
    {
        $query = $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.deletedAt = 0')
            ->orderBy('e.dateCreated', 'DESC')
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResults);

        return new Paginator($query);
    }
}