<?php

namespace App\Repository;

use App\Entity\DetailsAdoptions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailsAdoptions>
 *
 * @method DetailsAdoptions|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailsAdoptions|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailsAdoptions[]    findAll()
 * @method DetailsAdoptions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsAdoptionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailsAdoptions::class);
    }

    public function save(DetailsAdoptions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(DetailsAdoptions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return DetailsAdoptions[] Returns an array of DetailsAdoptions objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetailsAdoptions
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
