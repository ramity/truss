<?php

namespace App\Repository;

use App\Entity\VoiceChannelConnection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VoiceChannelConnection>
 *
 * @method VoiceChannelConnection|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoiceChannelConnection|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoiceChannelConnection[]    findAll()
 * @method VoiceChannelConnection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoiceChannelConnectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoiceChannelConnection::class);
    }

//    /**
//     * @return VoiceChannelConnection[] Returns an array of VoiceChannelConnection objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VoiceChannelConnection
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
