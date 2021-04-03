<?php

namespace App\Entity;

use App\Repository\IntermidiaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntermidiaireRepository::class)
 */
class Intermidiaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $DateTransaction;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Contract;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $Sens;

    /**
     * @ORM\ManyToOne(targetEntity=Valeur::class, inversedBy="intermidiaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Valeur;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $LibelleValeur;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $Caract;

    /**
     * @ORM\ManyToOne(targetEntity=CodeMarche::class, inversedBy="intermidiaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Marche;

    /**
     * @ORM\ManyToOne(targetEntity=CodeProfit::class, inversedBy="intermidiaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Profit;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $Client;

    /**
     * @ORM\ManyToOne(targetEntity=CodeCompteIntrm::class, inversedBy="intermidiaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeCompte;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $Pays;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Quantite;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $Cours;

    /**
     * @ORM\ManyToOne(targetEntity=Adherent::class, inversedBy="intermidiaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeAdrIntrm;

    /**
     * @ORM\ManyToOne(targetEntity=ReglementIntrm::class, inversedBy="intermidiaires")
     */
    private $Reglement;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Commission;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->DateTransaction;
    }

    public function setDateTransaction(\DateTimeInterface $DateTransaction): self
    {
        $this->DateTransaction = $DateTransaction;

        return $this;
    }

    public function getContract(): ?string
    {
        return $this->Contract;
    }

    public function setContract(string $Contract): self
    {
        $this->Contract = $Contract;

        return $this;
    }

    public function getSens(): ?string
    {
        return $this->Sens;
    }

    public function setSens(string $Sens): self
    {
        $this->Sens = $Sens;

        return $this;
    }

    public function getValeur(): ?Valeur
    {
        return $this->Valeur;
    }

    public function setValeur(?Valeur $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }

    public function getLibelleValeur(): ?string
    {
        return $this->LibelleValeur;
    }

    public function setLibelleValeur(?string $LibelleValeur): self
    {
        $this->LibelleValeur = $LibelleValeur;

        return $this;
    }

    public function getCaract(): ?string
    {
        return $this->Caract;
    }

    public function setCaract(?string $Caract): self
    {
        $this->Caract = $Caract;

        return $this;
    }

    public function getMarche(): ?CodeMarche
    {
        return $this->Marche;
    }

    public function setMarche(?CodeMarche $Marche): self
    {
        $this->Marche = $Marche;

        return $this;
    }

    public function getProfit(): ?CodeProfit
    {
        return $this->Profit;
    }

    public function setProfit(?CodeProfit $Profit): self
    {
        $this->Profit = $Profit;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->Client;
    }

    public function setClient(?string $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getTypeCompte(): ?CodeCompteIntrm
    {
        return $this->TypeCompte;
    }

    public function setTypeCompte(?CodeCompteIntrm $TypeCompte): self
    {
        $this->TypeCompte = $TypeCompte;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->Quantite;
    }

    public function setQuantite(string $Quantite): self
    {
        $this->Quantite = $Quantite;

        return $this;
    }

    public function getCours(): ?string
    {
        return $this->Cours;
    }

    public function setCours(string $Cours): self
    {
        $this->Cours = $Cours;

        return $this;
    }

    public function getCodeAdrIntrm(): ?Adherent
    {
        return $this->CodeAdrIntrm;
    }

    public function setCodeAdrIntrm(?Adherent $CodeAdrIntrm): self
    {
        $this->CodeAdrIntrm = $CodeAdrIntrm;

        return $this;
    }

    public function getReglement(): ?ReglementIntrm
    {
        return $this->Reglement;
    }

    public function setReglement(?ReglementIntrm $Reglement): self
    {
        $this->Reglement = $Reglement;

        return $this;
    }

    public function getCommission(): ?string
    {
        return $this->Commission;
    }

    public function setCommission(string $Commission): self
    {
        $this->Commission = $Commission;

        return $this;
    }

}
