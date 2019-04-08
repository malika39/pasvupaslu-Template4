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

    public function countEditeurs(): string
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function saveNewEditeur(Editeur $editeur): void
    {
        $this->_em->persist($editeur);
        $this->_em->flush();
    }
    public function saveExistingEditeur(): void
    {
        try {
            $this->_em->flush();
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
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
}