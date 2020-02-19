<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 * @UniqueEntity(fields="email", message="Email déjà pris")
 * @UniqueEntity(fields="username", message="Pseudo déjà pris")
 */
class Member implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=1070)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = ['ROLE_USER'];

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", inversedBy="member", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Site", inversedBy="member")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Outing", mappedBy="member")
     */
    private $outing;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subscribed", mappedBy="member", orphanRemoval=true)
     */
    private $subscribeds;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subscription", mappedBy="member")
     */
    private $subscriptions;

    public function __construct()
    {
        $this->outing = new ArrayCollection();
        $this->subscribeds = new ArrayCollection();
        $this->subscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        // set (or unset) the owning side of the relation if necessary
        $newMember = null === $image ? null : $this;
        if ($image->getMember() !== $newMember) {
            $image->setMember($newMember);
        }

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

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        if(empty($this->roles)){
            $this->roles = ['ROLE_USER'];
        }

        return $this->roles;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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
            $outing->addMember($this);
        }

        return $this;
    }

    public function removeOuting(Outing $outing): self
    {
        if ($this->outing->contains($outing)) {
            $this->outing->removeElement($outing);
            $outing->removeMember($this);
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->username;
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
            $subscribed->setMember($this);
        }

        return $this;
    }

    public function removeSubscribed(Subscribed $subscribed): self
    {
        if ($this->subscribeds->contains($subscribed)) {
            $this->subscribeds->removeElement($subscribed);
            // set the owning side to null (unless already changed)
            if ($subscribed->getMember() === $this) {
                $subscribed->setMember(null);
            }
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
            $subscription->setMember($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->contains($subscription)) {
            $this->subscriptions->removeElement($subscription);
            // set the owning side to null (unless already changed)
            if ($subscription->getMember() === $this) {
                $subscription->setMember(null);
            }
        }

        return $this;
    }

}
