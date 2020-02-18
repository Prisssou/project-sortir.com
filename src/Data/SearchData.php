<?php


namespace App\Data;


use DateTime;

class SearchData
{
    /**
     * @var string
     */
    private $q = '';

    public function getQ(): ?string
    {
        return $this->q;
    }

    public function setQ(string $q): self
    {
        $this->q = $q;

        return $this;
    }

    /**
     * @var string
     */
    private $motCle;

    public function getMotCle(): ?string
    {
        return $this->motCle;
    }

    public function setMotCle(string $motCle): self
    {
        $this->motCle = $motCle;

        return $this;
    }

    /**
     * @var DateTime|null
     */
    private $beginDate;

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->beginDate;
    }

    public function setBeginDate(?\DateTimeInterface $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    /**
     * @var DateTime|null
     *
     */
    private $endDate;

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @var integer
     */
    private $dureeMin;

    public function getDureeMin(): ?int
    {
        return $this->dureeMin;
    }

    public function setDureeMin(int $dureeMin): self
    {
        $this->dureeMin = $dureeMin;

        return $this;
    }

    /**
     * @var integer
     */
    private $dureeMax;

    public function getDureeMax(): ?int
    {
        return $this->dureeMax;
    }

    public function setDureeMax(int $dureeMax): self
    {
        $this->dureeMax = $dureeMax;

        return $this;
    }

    /**
     * @var boolean
     */
    private $orga;

    public function getOrga(): ?int
    {
        return $this->orga;
    }

    public function setOrga(int $orga): self
    {
        $this->orga = $orga;

        return $this;
    }


    /**
     * @var boolean
     */
    private $inscrit;

    public function getInscrit(): ?int
    {
        return $this->inscrit;
    }

    public function setInscrit(int $inscrit): self
    {
        $this->inscrit = $inscrit;

        return $this;
    }

    /**
     * @var boolean
     */
    private $notInscrit;

    public function getNotInscrit(): ?int
    {
        return $this->notInscrit;
    }

    public function setNotInscrit(int $notInscrit): self
    {
        $this->notInscrit = $notInscrit;

        return $this;
    }

    /**
     * @var boolean
     */
    private $passee;

    public function getPassee(): ?int
    {
        return $this->passee;
    }

    public function setPassee(int $passee): self
    {
        $this->passee = $passee;

        return $this;
    }

}