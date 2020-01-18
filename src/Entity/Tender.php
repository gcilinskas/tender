<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TenderRepository")
 */
class Tender
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"api"})
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"api"})
     */
    private $title;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"api"})
     */
    private $description;

    /**
     * @var DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var DateTime|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * Tender constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return Tender
     */
    public function setTitle(?string $title): Tender
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return Tender
     */
    public function setDescription(?string $description): Tender
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     *
     * @return Tender
     */
    public function setCreatedAt($createdAt): Tender
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param $updatedAt
     *
     * @return Tender
     */
    public function setUpdatedAt($updatedAt): Tender
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return int|null
     *
     * @Groups({"api"})
     */
    public function getUpdatedAtTimestamp(): ?int
    {
        return $this->getUpdatedAt()->getTimestamp();
    }

    /**
     * @return int|null
     *
     * @Groups({"api"})
     */
    public function getCreatedAtTimestamp(): ?int
    {
        return $this->getCreatedAt()->getTimestamp();
    }
}
