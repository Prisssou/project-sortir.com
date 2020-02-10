<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OutingRepository")
 */
class Outing
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $limitDateSub;

    /**
     * @ORM\Column(type="datetime")
     */
    private $closingDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberMaxSub;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberSub;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $cancelInfo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", inversedBy="Outing", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="outing")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\State", inversedBy="outing")
     * @ORM\JoinColumn(nullable=false)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="outing")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getLimitDateSub(): ?\DateTimeInterface
    {
        return $this->limitDateSub;
    }

    public function setLimitDateSub(\DateTimeInterface $limitDateSub): self
    {
        $this->limitDateSub = $limitDateSub;

        return $this;
    }

    public function getClosingDate(): ?\DateTimeInterface
    {
        return $this->closingDate;
    }

    public function setClosingDate(\DateTimeInterface $closingDate): self
    {
        $this->closingDate = $closingDate;

        return $this;
    }

    public function getNumberMaxSub(): ?int
    {
        return $this->numberMaxSub;
    }

    public function setNumberMaxSub(int $numberMaxSub): self
    {
        $this->numberMaxSub = $numberMaxSub;

        return $this;
    }

    public function getNumberSub(): ?int
    {
        return $this->numberSub;
    }

    public function setNumberSub(int $numberSub): self
    {
        $this->numberSub = $numberSub;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCancelInfo(): ?string
    {
        return $this->cancelInfo;
    }

    public function setCancelInfo(?string $cancelInfo): self
    {
        $this->cancelInfo = $cancelInfo;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }
}
