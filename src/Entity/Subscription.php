<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Outing", inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $outing;

    /**
     * @ORM\Column(type="datetime")
     */
    private $subDate;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOuting(): ?Outing
    {
        return $this->outing;
    }

    public function setOuting(?Outing $outing): self
    {
        $this->outing = $outing;

        return $this;
    }

    public function getSubDate(): ?\DateTimeInterface
    {
        return $this->subDate;
    }

    public function setSubDate(\DateTimeInterface $subDate): self
    {
        $this->subDate = $subDate;

        return $this;
    }
}
