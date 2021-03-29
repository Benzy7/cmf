<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $Isin;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $Quantity;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $Meaning;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $StockExchangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $AccountingDate;

    /**
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeAdherent;

    /**
     * @ORM\ManyToOne(targetEntity=CodeNature::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NatureCompte;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieAvoir::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategorieAvoir;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsin(): ?string
    {
        return $this->Isin;
    }

    public function setIsin(?string $Isin): self
    {
        $this->Isin = $Isin;

        return $this;
    }

    public function getQuantity(): ?string
    {
        return $this->Quantity;
    }

    public function setQuantity(string $Quantity): self
    {
        $this->Quantity = $Quantity;

        return $this;
    }

    public function getMeaning(): ?string
    {
        return $this->Meaning;
    }

    public function setMeaning(?string $Meaning): self
    {
        $this->Meaning = $Meaning;

        return $this;
    }

    public function getStockExchangeDate(): ?\DateTimeInterface
    {
        return $this->StockExchangeDate;
    }

    public function setStockExchangeDate(?\DateTimeInterface $StockExchangeDate): self
    {
        $this->StockExchangeDate = $StockExchangeDate;

        return $this;
    }

    public function getAccountingDate(): ?\DateTimeInterface
    {
        return $this->AccountingDate;
    }

    public function setAccountingDate(?\DateTimeInterface $AccountingDate): self
    {
        $this->AccountingDate = $AccountingDate;

        return $this;
    }

    public function getCodeAdherent(): ?Adherent
    {
        return $this->CodeAdherent;
    }

    public function setCodeAdherent(?Adherent $CodeAdherent): self
    {
        $this->CodeAdherent = $CodeAdherent;

        return $this;
    }

    public function getNatureCompte(): ?CodeNature
    {
        return $this->NatureCompte;
    }

    public function setNatureCompte(?CodeNature $NatureCompte): self
    {
        $this->NatureCompte = $NatureCompte;

        return $this;
    }

    public function getCategorieAvoir(): ?CategorieAvoir
    {
        return $this->CategorieAvoir;
    }

    public function setCategorieAvoir(?CategorieAvoir $CategorieAvoir): self
    {
        $this->CategorieAvoir = $CategorieAvoir;

        return $this;
    }
}
