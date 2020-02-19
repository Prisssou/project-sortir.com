<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codesPostaux;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codeDepartement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Place", mappedBy="ville")
     */
    private $place;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getCodesPostaux(): ?string
    {
        return $this->codesPostaux;
    }

    public function setCodesPostaux(string $codesPostaux): self
    {
        $this->codesPostaux = $codesPostaux;

        return $this;
    }

    public function getCodeDepartement(): ?int
    {
        return $this->codeDepartement;
    }

    public function setCodeDepartement(int $codeDepartement): self
    {
        $this->codeDepartement = $codeDepartement;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getPlace(): Collection
    {
        return $this->place;
    }

    public function addPlace(Place $place)
    {
        if (!$this->place->contains($place)) {
            $this->place[] = $place;
            $place->setCity($this);
        }

        return $this;
    }

    public function removePlace(Place $place)
    {
        if ($this->place->contains($place)) {
            $this->place->removeElement($place);
            // set the owning side to null (unless already changed)
            if ($place->getCity() === $this) {
                $place->setCity(null);
            }
        }

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }
}
