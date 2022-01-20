<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
class Link
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="media_url", type="string", nullable=true)
     */
    protected $mediaURL;

    /**
     * @var string
     *
     * @ORM\Column(name="provider_name", type="string", nullable=true)
     */
    protected $providerName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $author;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_add", type="date", nullable=true)
     */
    protected $dateAdd;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_publish", type="date", nullable=true)
     * @Serializer\Exclude()
     */
    protected $datePublish;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string|null $url
     *
     * @return self
     */
    public function setURL(?string $url): self
    {
        $this->mediaURL = $url;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getURL(): ?string
    {
        return $this->mediaURL;
    }

    /**
     * @param string|null $providerName
     *
     * @return self
     */
    public function setProviderName(?string $providerName): self
    {
        $this->providerName = $providerName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProviderName(): ?string
    {
        return $this->providerName;
    }

    /**
     * @param string|null $title
     *
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $author
     *
     * @return self
     */
    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param \DateTime|null $date
     *
     * @return self
     */
    public function setDateAdd(?\DateTime $date): self
    {
        $this->dateAdd = $date;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    /**
     * @param \DateTime|null $date
     *
     * @return self
     */
    public function setDatePublish(?\DateTime $date): self
    {
        $this->datePublish = $date;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDatePublish(): ?\DateTimeInterface
    {
        return $this->datePublish;
    }
}
