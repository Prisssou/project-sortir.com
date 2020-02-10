<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $url;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Member", mappedBy="image", cascade={"persist", "remove"})
     */
    private $member;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Outing", mappedBy="image", cascade={"persist", "remove"})
     */
    private $Outing;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getOuting(): ?Outing
    {
        return $this->Outing;
    }

    public function setOuting(?Outing $Outing): self
    {
        $this->Outing = $Outing;

        // set (or unset) the owning side of the relation if necessary
        $newImage = null === $Outing ? null : $this;
        if ($Outing->getImage() !== $newImage) {
            $Outing->setImage($newImage);
        }

        return $this;
    }
}
