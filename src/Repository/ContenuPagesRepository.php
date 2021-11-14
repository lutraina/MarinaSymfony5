<?php

namespace App\Repository;

use App\Entity\ContenuPages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContenuPages|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContenuPages|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContenuPages[]    findAll()
 * @method ContenuPages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContenuPagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContenuPages::class);
    }

    /**
     * @return ContenuPages[] Returns an array of ContenuPages objects
     */
     
    public function findOneByPageAndSection($page, $section)
    {   
        return $this->createQueryBuilder('c')
            ->andWhere('c.pages = :val')
            ->setParameter('val', $page)
            ->andWhere('c.sections = :val2')
            ->setParameter('val2', $section)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
        //dd($res);
    }
    

    /*
    public function findOneBySomeField($value): ?ContenuPages
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
