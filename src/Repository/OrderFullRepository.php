<?php

namespace App\Repository;

use App\Entity\OrderFull;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderFull>
 *
 * @method OrderFull|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderFull|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderFull[]    findAll()
 * @method OrderFull[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderFullRepository extends ServiceEntityRepository
{


    //    /**
    //     * @return OrderFull[] Returns an array of OrderFull objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?OrderFull
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
