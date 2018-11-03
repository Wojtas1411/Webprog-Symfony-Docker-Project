<?php

namespace App\Repository;

use App\Entity\JobData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method JobData|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobData|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobData[]    findAll()
 * @method JobData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, JobData::class);
    }

//    /**
//     * @return JobData[] Returns an array of JobData objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobData
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
