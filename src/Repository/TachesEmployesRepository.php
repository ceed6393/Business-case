<?php

namespace App\Repository;

use App\Entity\TachesEmployes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TachesEmployes>
 *
 * @method TachesEmployes|null find($id, $lockMode = null, $lockVersion = null)
 * @method TachesEmployes|null findOneBy(array $criteria, array $orderBy = null)
 * @method TachesEmployes[]    findAll()
 * @method TachesEmployes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TachesEmployesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TachesEmployes::class);
    }

//    /**
//     * @return TachesEmployes[] Returns an array of TachesEmployes objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TachesEmployes
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
