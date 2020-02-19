<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OutingRepository")
 */
class Outing implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return ['id' => $this->getId(),
                'state' => $this->getState()];
    }


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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Member", inversedBy="outing")
     */
    private $member;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Subscribed", mappedBy="outing")
     */
    private $subscribeds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subscription", mappedBy="outing")
     */
    private $subscriptions;

    public function __construct()
    {
        $this->member = new ArrayCollection();
        $this->subscribeds = new ArrayCollection();
        $this->subscriptions = new ArrayCollection();
    }

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

    /**
     * @return Collection|Member[]
     */
    public function getMember(): Collection
    {
        return $this->member;
    }

    public function addMember(Member $member): self
    {
        if (!$this->member->contains($member)) {
            $this->member[] = $member;
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->member->contains($member)) {
            $this->member->removeElement($member);
        }

        return $this;
    }

    /**
     * @return Collection|Subscribed[]
     */
    public function getSubscribeds(): Collection
    {
        return $this->subscribeds;
    }

    public function addSubscribed(Subscribed $subscribed): self
    {
        if (!$this->subscribeds->contains($subscribed)) {
            $this->subscribeds[] = $subscribed;
            $subscribed->addOuting($this);
        }

        return $this;
    }

    public function removeSubscribed(Subscribed $subscribed): self
    {
        if ($this->subscribeds->contains($subscribed)) {
            $this->subscribeds->removeElement($subscribed);
            $subscribed->removeOuting($this);
        }

        return $this;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setOuting($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->contains($subscription)) {
            $this->subscriptions->removeElement($subscription);
            // set the owning side to null (unless already changed)
            if ($subscription->getOuting() === $this) {
                $subscription->setOuting(null);
            }
        }

        return $this;
    }
}