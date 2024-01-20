<?php

namespace App\Repository;

use App\Entity\NombreDeConvive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NombreDeConvive>
 *
 * @method NombreDeConvive|null find($id, $lockMode = null, $lockVersion = null)
 * @method NombreDeConvive|null findOneBy(array $criteria, array $orderBy = null)
 * @method NombreDeConvive[]    findAll()
 * @method NombreDeConvive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NombreDeConviveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NombreDeConvive::class);
    }

//    /**
//     * @return NombreDeConvive[] Returns an array of NombreDeConvive objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NombreDeConvive
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
