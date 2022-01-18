<?php


namespace App\Repository;

use App\Entity\LinkFlickr;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @method LinkFlickr|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkFlickr|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkFlickr[]    findAll()
 * @method LinkFlickr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkFlickrRepository extends ServiceEntityRepository
{
    /**
     * @param \Doctrine\Persistence\ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkFlickr::class);
    }
}
