<?php

namespace App\Repository;

use App\Entity\TextChannel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TextChannel>
 *
 * @method TextChannel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextChannel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextChannel[]    findAll()
 * @method TextChannel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TextChannelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextChannel::class);
    }

//    /**
//     * @return TextChannel[] Returns an array of TextChannel objects
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

//    public function findOneBySomeField($value): ?TextChannel
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
