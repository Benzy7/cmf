<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class StockSearch
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
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Scodead;
    /**
     * @var String|null
     */
    private $Tcodead;

    /**
     * @var String|null
     */
    private $Sisin;
    /**
     * @var String|null
     */
    private $Tisin;

    /**
     * @ORM\ManyToOne(targetEntity=CodeNature::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Scoden;
     /**
     * @var String|null
     */
    private $Tcoden;

    /**
     * @var String[]|null
     */
    private $TypeAdherents = [];

    /**
     * @var String|null
     */
    private $Valeurs = [];

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

    public function setScodead(?Adherent $Scodead): self
    {
        $this->Scodead = $Scodead;

        return $this;
    }
    public function setTcodead(?string $Tcodead): self
    {
        $this->Tcodead = $Tcodead;

        return $this;
    }

    public function setScoden(?CodeNature $Scoden): self
    {
        $this->Scoden = $Scoden;

        return $this;
    }
    public function setTcoden(?string $Tcoden): self
    {
        $this->Tcoden = $Tcoden;

        return $this;
    }

    public function setTypeAdherents(?array $TypeAdherents): self
    {
        $this->TypeAdherents = $TypeAdherents;

        return $this;
    }

    public function setValeurs(?array $Valeurs): self
    {
        $this->Valeurs = $Valeurs;

        return $this;
    }



    public function getTcodead(): ?string
    {
        return $this->Tcodead;
    }
    public function getScodead(): ?Adherent
    {
        return $this->Scodead;
    }

    public function getTcoden(): ?string
    {
        return $this->Tcoden;
    }
    public function getScoden(): ?CodeNature
    {
        return $this->Scoden;
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

    public function getTypeAdherents(): ?array
    {
        return $this->TypeAdherents;
    }

    public function getValeurs(): ?array
    {
        return $this->Valeurs;
    }

}
