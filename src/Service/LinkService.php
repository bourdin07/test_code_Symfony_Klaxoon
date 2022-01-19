<?php

namespace App\Service;

use App\Entity\Link;
use App\Entity\LinkPhoto;
use App\Entity\LinkVideo;
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

    public function createLinkVideo(array $data)
    {
        $linkVideo = new LinkVideo();
        $linkVideo->setProviderName($data["providerName"]);
        $linkVideo->setTitle($data["title"]);
        $linkVideo->setAuthor($data["author"]);
        $linkVideo->setDateAdd(new \DateTime());
        $linkVideo->setDatePublish(new \DateTime($data["publishDate"]));
        $linkVideo->setWidth($data["width"]);
        $linkVideo->setHeight($data["height"]);
        $linkVideo->setLength($data["duration"]);
        $linkVideo->setURL($data["URL"]);

        $this->manager->persist($linkVideo);
        $this->manager->flush();

        return $linkVideo;
    }

    public function createLinkPhoto(array $data)
    {
        $linkPhoto = new LinkPhoto();
        $linkPhoto->setProviderName($data["providerName"]);
        $linkPhoto->setTitle($data["title"]);
        $linkPhoto->setAuthor($data["author"]);
        $linkPhoto->setDateAdd(new \DateTime());
        $linkPhoto->setDatePublish(new \DateTime($data["publishDate"]));
        $linkPhoto->setWidth($data["width"]);
        $linkPhoto->setHeight($data["height"]);
        $linkPhoto->setURL($data["URL"]);

        $this->manager->persist($linkPhoto);
        $this->manager->flush();

        return $linkPhoto;
    }

    public function deleteLink($id)
    {
        $this->manager->remove($this->linkRepository->find($id));
        $this->manager->flush();

        return $id;
    }
}
