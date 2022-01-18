<?php

namespace App\Repository;

use App\Entity\LinkVimeo;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @method LinkVimeo|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkVimeo|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkVimeo[]    findAll()
 * @method LinkVimeo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkVimeoRepository extends ServiceEntityRepository
{
    /**
     * @param \Doctrine\Persistence\ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkVimeo::class);
    }
}
