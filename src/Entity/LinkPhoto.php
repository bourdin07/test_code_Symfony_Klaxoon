<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkPhotoRepository")
 */
class LinkPhoto extends Link
{
    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @var int
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @param integer|null $w
     *
     * @return self
     */
    public function setWidth(?int $w): self
    {
        $this->width = $w;

        return $this;
    }

    /**
     * @return integer|null
     */
    public function getWidth(): ?int
    {
        return $this->width;
    }

    /**
     * @param integer|null $h
     *
     * @return self
     */
    public function setHeight(?int $h): self
    {
        $this->height = $h;

        return $this;
    }

    /**
     * @return integer|null
     */
    public function getHeight(): ?int
    {
        return $this->height;
    }
}
