<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class MouvementSearch
{
    /**
     * @var Date|null
     */
    private $Datebdeb;
    /**
     * @var Date|null
     */
    private $Datebfin;

    /**
     * @var String|null
     */
    private $Dateadeb;
    /**
     * @var String|null
     */
    private $Dateafin;

    /**
     * @ORM\ManyToOne(targetEntity=Operation::class, inversedBy="mouvements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Scodeop;
    /**
     * @var String|null
     */
    private $Tcodeop;

    /**
     * @var String|null
     */
    private $Sisin;
    /**
     * @var String|null
     */
    private $Tisin;


    /**
     * @var String[]|null
     */
    private $Livreurs = [];

    /**
     * @var String|null
     */
    private $Livres = [];

    public function setDatebdeb(?\DateTimeInterface $Datebdeb): self
    {
        $this->Datebdeb = $Datebdeb;

        return $this;
    }
    public function setDatebfin(?\DateTimeInterface $Datebfin): self
    {
        $this->Datebfin = $Datebfin;

        return $this;
    }

    public function setDateadeb(?\DateTimeInterface $Dateadeb): self
    {
        $this->Dateadeb = $Dateadeb;

        return $this;
    }
    public function setDateafin(?\DateTimeInterface $Dateafin): self
    {
        $this->Dateafin = $Dateafin;

        return $this;
    }

    public function setSisin(?string $Sisin): self
    {
        $this->Sisin = $Sisin;

        return $this;
    }
    public function setTisin(?string $Tisin): self
    {
        $this->Tisin = $Tisin;

        return $this;
    }

    public function setScodeop(?Operation $Scodeop): self
    {
        $this->Scodeop = $Scodeop;

        return $this;
    }
    public function setTcodeop(?string $Tcodeop): self
    {
        $this->Tcodeop = $Tcodeop;

        return $this;
    }

    public function setLivreurs(?array $Livreurs): self
    {
        $this->Livreurs = $Livreurs;

        return $this;
    }

    public function setLivres(?array $Livres): self
    {
        $this->Livres = $Livres;

        return $this;
    }



    public function getTcodeop(): ?string
    {
        return $this->Tcodeop;
    }
    public function getScodeop(): ?Operation
    {
        return $this->Scodeop;
    }

    public function getSisin(): ?string
    {
        return $this->Sisin;
    }
    public function getTisin(): ?string
    {
        return $this->Tisin;
    }

    public function getDatebdeb(): ?\DateTimeInterface
    {
        return $this->Datebdeb;
    }
    public function getDatebfin(): ?\DateTimeInterface
    {
        return $this->Datebfin;
    }

    public function getDateadeb(): ?\DateTimeInterface
    {
        return $this->Dateadeb;
    }
    public function getDateafin(): ?\DateTimeInterface
    {
        return $this->Dateafin;
    }

    public function getLivreurs(): ?array
    {
        return $this->Livreurs;
    }

    public function getLivres(): ?array
    {
        return $this->Livres;
    }

}
