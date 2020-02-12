<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscribedRepository")
 */
class Subscribed
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Outing", inversedBy="subscribeds")
     */
    private $outing;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="subscribeds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    public function __construct()
    {
        $this->outing = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Outing[]
     */
    public function getOuting(): Collection
    {
        return $this->outing;
    }

    public function addOuting(Outing $outing): self
    {
        if (!$this->outing->contains($outing)) {
            $this->outing[] = $outing;
        }

        return $this;
    }

    public function removeOuting(Outing $outing): self
    {
        if ($this->outing->contains($outing)) {
            $this->outing->removeElement($outing);
        }

        return $this;
    }

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member): self
    {
        $this->member = $member;

        return $this;
    }
}
