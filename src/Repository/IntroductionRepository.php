<?php

namespace App\Repository;

use App\Entity\Introduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Introduction>
 *
 * @method Introduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Introduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Introduction[]    findAll()
 * @method Introduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntroductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Introduction::class);
    }

    public function save(Introduction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Introduction $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Introduction[] Returns an array of Introduction objects
//     */
    public function findByLanguage($value): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.translations = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findIntro(): ?Introduction
    {
        return $this->createQueryBuilder('i')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
