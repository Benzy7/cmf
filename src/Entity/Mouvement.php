<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MouvementRepository")
 */
class Mouvement
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $StockExchangeDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $AccounttingDate;

    /**
     * @ORM\ManyToOne(targetEntity=Operation::class, inversedBy="mouvements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeOperation;

    /**
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="mouvements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeAdherentLivreur;

    /**
     * @ORM\ManyToOne(targetEntity=CodeNature::class, inversedBy="mouvements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NatureCompteLivreur;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieAvoir::class, inversedBy="mouvements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategorieAvoirLivreur;

    /**
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="mouvementl")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeAdherentLivre;

    /**
     * @ORM\ManyToOne(targetEntity=CodeNature::class, inversedBy="mouvementl")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NatureCompteLivre;

    /**
     * @ORM\ManyToOne(targetEntity=CategorieAvoir::class, inversedBy="mouvementl")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategorieAvoirLivre;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $TitlesNumber;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $Amount;

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

    public function getStockExchangeDate(): ?\DateTimeInterface
    {
        return $this->StockExchangeDate;
    }

    public function setStockExchangeDate(?\DateTimeInterface $StockExchangeDate): self
    {
        $this->StockExchangeDate = $StockExchangeDate;

        return $this;
    }

    public function getAccounttingDate(): ?\DateTimeInterface
    {
        return $this->AccounttingDate;
    }

    public function setAccounttingDate(?\DateTimeInterface $AccounttingDate): self
    {
        $this->AccounttingDate = $AccounttingDate;

        return $this;
    }

    public function getTitlesNumber(): ?string
    {
        return $this->TitlesNumber;
    }

    public function setTitlesNumber(?string $TitlesNumber): self
    {
        $this->TitlesNumber = $TitlesNumber;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(?string $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getCodeOperation(): ?Operation
    {
        return $this->CodeOperation;
    }

    public function setCodeOperation(?Operation $CodeOperation): self
    {
        $this->CodeOperation = $CodeOperation;

        return $this;
    }

    public function getCodeAdherentLivreur(): ?Adherent
    {
        return $this->CodeAdherentLivreur;
    }

    public function setCodeAdherentLivreur(?Adherent $CodeAdherentLivreur): self
    {
        $this->CodeAdherentLivreur = $CodeAdherentLivreur;

        return $this;
    }

    public function getNatureCompteLivreur(): ?CodeNature
    {
        return $this->NatureCompteLivreur;
    }

    public function setNatureCompteLivreur(?CodeNature $NatureCompteLivreur): self
    {
        $this->NatureCompteLivreur = $NatureCompteLivreur;

        return $this;
    }

    public function getCategorieAvoirLivreur(): ?CategorieAvoir
    {
        return $this->CategorieAvoirLivreur;
    }

    public function setCategorieAvoirLivreur(?CategorieAvoir $CategorieAvoirLivreur): self
    {
        $this->CategorieAvoirLivreur = $CategorieAvoirLivreur;

        return $this;
    }

    public function getCodeAdherentLivre(): ?Adherent
    {
        return $this->CodeAdherentLivre;
    }

    public function setCodeAdherentLivre(?Adherent $CodeAdherentLivre): self
    {
        $this->CodeAdherentLivre = $CodeAdherentLivre;

        return $this;
    }

    public function getNatureCompteLivre(): ?CodeNature
    {
        return $this->NatureCompteLivre;
    }

    public function setNatureCompteLivre(?CodeNature $NatureCompteLivre): self
    {
        $this->NatureCompteLivre = $NatureCompteLivre;

        return $this;
    }

    public function getCategorieAvoirLivre(): ?CategorieAvoir
    {
        return $this->CategorieAvoirLivre;
    }

    public function setCategorieAvoirLivre(?CategorieAvoir $CategorieAvoirLivre): self
    {
        $this->CategorieAvoirLivre = $CategorieAvoirLivre;

        return $this;
    }
}
