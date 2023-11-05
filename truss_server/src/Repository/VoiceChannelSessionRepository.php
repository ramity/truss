<?php

namespace App\Repository;

use App\Entity\VoiceChannelSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VoiceChannelSession>
 *
 * @method VoiceChannelSession|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoiceChannelSession|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoiceChannelSession[]    findAll()
 * @method VoiceChannelSession[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoiceChannelSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VoiceChannelSession::class);
    }

//    /**
//     * @return VoiceChannelSession[] Returns an array of VoiceChannelSession objects
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

//    public function findOneBySomeField($value): ?VoiceChannelSession
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
