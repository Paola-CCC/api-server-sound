<?php

namespace App\Repository;

use App\Entity\Conversation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conversation>
 *
 * @method Conversation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conversation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conversation[]    findAll()
 * @method Conversation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConversationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conversation::class);
    }

    public function save(Conversation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Conversation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByUsers(string $userOne, string $userTwo): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.userOne = :userOne AND c.userTwo = :userTwo')
            ->orWhere('c.userOne = :userTwo AND c.userTwo = :userOne')
            ->setParameter('userOne', $userOne)
            ->setParameter('userTwo', $userTwo)
            ->getQuery()
            ->getResult();
    }

    public function findByProfessor(string $userTwo): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.userTwo = :userTwo')
            ->setParameter('userTwo', $userTwo)
            ->getQuery()
            ->getResult();
    }

    public function findByStudent(string $userOne): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.userOne = :userOne')
            ->setParameter('userOne', $userOne)
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Conversation[] Returns an array of Conversation objects
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

//    public function findOneBySomeField($value): ?Conversation
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
