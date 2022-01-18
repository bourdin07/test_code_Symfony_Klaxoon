<?php

namespace App\Service;

use App\Entity\Link;
use App\Entity\LinkFlickr;
use App\Entity\LinkVimeo;
use App\Repository\LinkRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class LinkService
{
    /** @var EntityManagerInterface $manager */
    private $manager;

    /** @var LinkRepository */
    private $linkRepository;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        $this->linkRepository = $this->manager->getRepository(Link::class);
    }

    public function getAll()
    {
        return $this->linkRepository->findAll();
    }

    public function createLinkVimeo(array $data)
    {
        $linkVimeo = new LinkVimeo();
        $linkVimeo->setProviderName($data["providerName"]);
        $linkVimeo->setTitle($data["title"]);
        $linkVimeo->setAuthor($data["author"]);
        $linkVimeo->setDateAdd(new \DateTime());
        $linkVimeo->setDatePublish(new \DateTime($data["publishDate"]));
        $linkVimeo->setWidth($data["width"]);
        $linkVimeo->setHeight($data["height"]);
        $linkVimeo->setLength($data["duration"]);
        $linkVimeo->setURL($data["URL"]);

        $this->manager->persist($linkVimeo);
        $this->manager->flush();

        return $linkVimeo;
    }

    public function createLinkFlickr(array $data)
    {
        $linkFlickr = new LinkFlickr();
        $linkFlickr->setProviderName($data["providerName"]);
        $linkFlickr->setTitle($data["title"]);
        $linkFlickr->setAuthor($data["author"]);
        $linkFlickr->setDateAdd(new \DateTime());
        $linkFlickr->setDatePublish(new \DateTime($data["publishDate"]));
        $linkFlickr->setWidth($data["width"]);
        $linkFlickr->setHeight($data["height"]);
        $linkFlickr->setURL($data["URL"]);

        $this->manager->persist($linkFlickr);
        $this->manager->flush();

        return $linkFlickr;
    }

    public function deleteLink($id)
    {
        $this->manager->remove($this->linkRepository->find($id));
        $this->manager->flush();

        return $id;
    }
}
