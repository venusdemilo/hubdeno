<?php

namespace App\Repository;

use App\Repository\UserRepository;
use App\Entity\Sick;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

/**
 * @extends ServiceEntityRepository<Sick>
 *
 * @method Sick|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sick|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sick[]    findAll()
 * @method Sick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SickRepository extends ServiceEntityRepository
{
    private $security;
    private $user;
    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Sick::class);
        $this->security = $security;
        $this->user = $this->security->getUser();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Sick $entity, bool $flush = true): void
    {
        $this->user->addSick($entity);
        $entity->addUser($this->user);
        $this->_em->persist($entity);
        $this->_em->persist($this->user);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Sick $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Sick[] Returns an array of Sick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sick
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
