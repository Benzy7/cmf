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
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $CodeIsin;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $Valeur;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $Caracteristique;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $Marche;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $Profit;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $Client;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $TypeCompte;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $Pays;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $Qte;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $Cours;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $CodeIntermidiaire;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $Reglement;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
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

    public function getCodeIsin(): ?string
    {
        return $this->CodeIsin;
    }

    public function setCodeIsin(?string $CodeIsin): self
    {
        $this->CodeIsin = $CodeIsin;

        return $this;
    }

    public function getValeur(): ?string
    {
        return $this->Valeur;
    }

    public function setValeur(?string $Valeur): self
    {
        $this->Valeur = $Valeur;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->Caracteristique;
    }

    public function setCaracteristique(?string $Caracteristique): self
    {
        $this->Caracteristique = $Caracteristique;

        return $this;
    }

    public function getMarche(): ?string
    {
        return $this->Marche;
    }

    public function setMarche(?string $Marche): self
    {
        $this->Marche = $Marche;

        return $this;
    }

    public function getProfit(): ?string
    {
        return $this->Profit;
    }

    public function setProfit(?string $Profit): self
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

    public function getTypeCompte(): ?string
    {
        return $this->TypeCompte;
    }

    public function setTypeCompte(?string $TypeCompte): self
    {
        $this->TypeCompte = $TypeCompte;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(?string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getQte(): ?string
    {
        return $this->Qte;
    }

    public function setQte(?string $Qte): self
    {
        $this->Qte = $Qte;

        return $this;
    }

    public function getCours(): ?string
    {
        return $this->Cours;
    }

    public function setCours(?string $Cours): self
    {
        $this->Cours = $Cours;

        return $this;
    }

    public function getCodeIntermidiaire(): ?string
    {
        return $this->CodeIntermidiaire;
    }

    public function setCodeIntermidiaire(?string $CodeIntermidiaire): self
    {
        $this->CodeIntermidiaire = $CodeIntermidiaire;

        return $this;
    }

    public function getReglement(): ?string
    {
        return $this->Reglement;
    }

    public function setReglement(?string $Reglement): self
    {
        $this->Reglement = $Reglement;

        return $this;
    }

    public function getCommission(): ?string
    {
        return $this->Commission;
    }

    public function setCommission(?string $Commission): self
    {
        $this->Commission = $Commission;

        return $this;
    }
}
