<?php

namespace App\Repository;

use App\Entity\Innovation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Innovation>
 *
 * @method Innovation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Innovation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Innovation[]    findAll()
 * @method Innovation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InnovationRepository extends ServiceEntityRepository
{


    //    /**
    //     * @return Innovation[] Returns an array of Innovation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Innovation
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
