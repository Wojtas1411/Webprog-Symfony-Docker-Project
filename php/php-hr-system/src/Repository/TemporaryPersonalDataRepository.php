<?php

namespace App\Repository;

use App\Entity\TemporaryPersonalData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TemporaryPersonalData|null find($id, $lockMode = null, $lockVersion = null)
 * @method TemporaryPersonalData|null findOneBy(array $criteria, array $orderBy = null)
 * @method TemporaryPersonalData[]    findAll()
 * @method TemporaryPersonalData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TemporaryPersonalDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TemporaryPersonalData::class);
    }

//    /**
//     * @return TemporaryPersonalData[] Returns an array of TemporaryPersonalData objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TemporaryPersonalData
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
