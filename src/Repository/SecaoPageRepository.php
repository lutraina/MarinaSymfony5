<?php

namespace App\Repository;

use App\Entity\SecaoPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SecaoPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecaoPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecaoPage[]    findAll()
 * @method SecaoPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecaoPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecaoPage::class);
    }

    // /**
    //  * @return SecaoPage[] Returns an array of SecaoPage objects
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
    public function findOneBySomeField($value): ?SecaoPage
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
