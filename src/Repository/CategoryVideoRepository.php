<?php

namespace App\Repository;

use App\Entity\CategoryVideo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoryVideo>
 *
 * @method CategoryVideo|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryVideo|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryVideo[]    findAll()
 * @method CategoryVideo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryVideoRepository extends ServiceEntityRepository
{


    //    /**
    //     * @return CategoryVideo[] Returns an array of CategoryVideo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CategoryVideo
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
