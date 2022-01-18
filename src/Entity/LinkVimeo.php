<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LinkVimeoRepository")
 */
class LinkVimeo extends Link implements \JsonSerializable
{
    /**
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $res = [];

        foreach ($this as $key => $value) {
            $res[$key] = $value;
        }

        return $res;
    }

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
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $length;

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

    /**
     * @param float|null $f
     *
     * @return self
     */
    public function setLength(?float $f): self
    {
        $this->length = $f;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLength(): ?float
    {
        return $this->length;
    }
}
