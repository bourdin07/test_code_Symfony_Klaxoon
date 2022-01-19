<?php


namespace App\Repository;

use App\Entity\LinkPhoto;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @method LinkPhoto|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkPhoto|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkPhoto[]    findAll()
 * @method LinkPhoto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkPhotoRepository extends ServiceEntityRepository
{
    /**
     * @param \Doctrine\Persistence\ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkPhoto::class);
    }
}
