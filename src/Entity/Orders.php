<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $TypeEnrg;

    /**
     * @ORM\ManyToOne(targetEntity=Valeur::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeValeur;

    /**
     * @ORM\ManyToOne(targetEntity=AdhrentIntermidiaire::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CodeAdi;

    /**
     * @ORM\Column(type="date")
     */
    private $DateEntreeOrdre;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DateModOrdre;

    /**
     * @ORM\Column(type="date")
     */
    private $DateFinVldOrdre;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureEntreeOrdre;

    /**
     * @ORM\Column(type="time")
     */
    private $HeureFinTrtOrdre;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $IndcGel;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $IndCrossOrd;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $SensOrd;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $NscOrd;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $NscOrdMod;

    /**
     * @ORM\Column(type="string", length=19)
     */
    private $PrixOrd;

    /**
     * @ORM\Column(type="string", length=18)
     */
    private $QteDev;

    /**
     * @ORM\Column(type="string", length=18)
     */
    private $QteMin;

    /**
     * @ORM\Column(type="string", length=18)
     */
    private $QteNeg;

    /**
     * @ORM\Column(type="string", length=18)
     */
    private $QteTot;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $OrgOrd;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $SusHub;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $TypePrixOrg;

    /**
     * @ORM\Column(type="string", length=19)
     */
    private $PrixStpOrdTrg;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $TradIdn;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $DestIdn;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $TypeCpt;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $NcptCl;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $NtradOrd;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateHeureEntreeOrd;

    /**
     * @ORM\Column(type="string", length=18, nullable=true)
     */
    private $TxtLibr;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $PostActionOrd;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $PostActionGvOrd;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $RefOrd;

    /**
     * @ORM\ManyToOne(targetEntity=OrdTypePrix::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypePrixOrd;

    /**
     * @ORM\ManyToOne(targetEntity=OrdTypeVld::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeVldOrd;

    /**
     * @ORM\ManyToOne(targetEntity=OrdStat::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $StatOrd;

    /**
     * @ORM\Column(type="date")
     */
    private $DateFicher;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeEnrg(): ?string
    {
        return $this->TypeEnrg;
    }

    public function setTypeEnrg(string $TypeEnrg): self
    {
        $this->TypeEnrg = $TypeEnrg;

        return $this;
    }

    public function getCodeValeur(): ?Valeur
    {
        return $this->CodeValeur;
    }

    public function setCodeValeur(?Valeur $CodeValeur): self
    {
        $this->CodeValeur = $CodeValeur;

        return $this;
    }

    public function getCodeAdi(): ?AdhrentIntermidiaire
    {
        return $this->CodeAdi;
    }

    public function setCodeAdi(?AdhrentIntermidiaire $CodeAdi): self
    {
        $this->CodeAdi = $CodeAdi;

        return $this;
    }

    public function getDateEntreeOrdre(): ?\DateTimeInterface
    {
        return $this->DateEntreeOrdre;
    }

    public function setDateEntreeOrdre(\DateTimeInterface $DateEntreeOrdre): self
    {
        $this->DateEntreeOrdre = $DateEntreeOrdre;

        return $this;
    }

    public function getDateModOrdre(): ?\DateTimeInterface
    {
        return $this->DateModOrdre;
    }

    public function setDateModOrdre(?\DateTimeInterface $DateModOrdre): self
    {
        $this->DateModOrdre = $DateModOrdre;

        return $this;
    }

    public function getDateFinVldOrdre(): ?\DateTimeInterface
    {
        return $this->DateFinVldOrdre;
    }

    public function setDateFinVldOrdre(\DateTimeInterface $DateFinVldOrdre): self
    {
        $this->DateFinVldOrdre = $DateFinVldOrdre;

        return $this;
    }

    public function getHeureEntreeOrdre(): ?\DateTimeInterface
    {
        return $this->HeureEntreeOrdre;
    }

    public function setHeureEntreeOrdre(\DateTimeInterface $HeureEntreeOrdre): self
    {
        $this->HeureEntreeOrdre = $HeureEntreeOrdre;

        return $this;
    }

    public function getHeureFinTrtOrdre(): ?\DateTimeInterface
    {
        return $this->HeureFinTrtOrdre;
    }

    public function setHeureFinTrtOrdre(\DateTimeInterface $HeureFinTrtOrdre): self
    {
        $this->HeureFinTrtOrdre = $HeureFinTrtOrdre;

        return $this;
    }

    public function getIndcGel(): ?string
    {
        return $this->IndcGel;
    }

    public function setIndcGel(string $IndcGel): self
    {
        $this->IndcGel = $IndcGel;

        return $this;
    }

    public function getIndCrossOrd(): ?string
    {
        return $this->IndCrossOrd;
    }

    public function setIndCrossOrd(string $IndCrossOrd): self
    {
        $this->IndCrossOrd = $IndCrossOrd;

        return $this;
    }

    public function getSensOrd(): ?string
    {
        return $this->SensOrd;
    }

    public function setSensOrd(string $SensOrd): self
    {
        $this->SensOrd = $SensOrd;

        return $this;
    }

    public function getNscOrd(): ?string
    {
        return $this->NscOrd;
    }

    public function setNscOrd(string $NscOrd): self
    {
        $this->NscOrd = $NscOrd;

        return $this;
    }

    public function getNscOrdMod(): ?string
    {
        return $this->NscOrdMod;
    }

    public function setNscOrdMod(?string $NscOrdMod): self
    {
        $this->NscOrdMod = $NscOrdMod;

        return $this;
    }

    public function getPrixOrd(): ?string
    {
        return $this->PrixOrd;
    }

    public function setPrixOrd(string $PrixOrd): self
    {
        $this->PrixOrd = $PrixOrd;

        return $this;
    }

    public function getQteDev(): ?string
    {
        return $this->QteDev;
    }

    public function setQteDev(string $QteDev): self
    {
        $this->QteDev = $QteDev;

        return $this;
    }

    public function getQteMin(): ?string
    {
        return $this->QteMin;
    }

    public function setQteMin(string $QteMin): self
    {
        $this->QteMin = $QteMin;

        return $this;
    }

    public function getQteNeg(): ?string
    {
        return $this->QteNeg;
    }

    public function setQteNeg(string $QteNeg): self
    {
        $this->QteNeg = $QteNeg;

        return $this;
    }

    public function getQteTot(): ?string
    {
        return $this->QteTot;
    }

    public function setQteTot(string $QteTot): self
    {
        $this->QteTot = $QteTot;

        return $this;
    }

    public function getOrgOrd(): ?string
    {
        return $this->OrgOrd;
    }

    public function setOrgOrd(string $OrgOrd): self
    {
        $this->OrgOrd = $OrgOrd;

        return $this;
    }

    public function getSusHub(): ?string
    {
        return $this->SusHub;
    }

    public function setSusHub(string $SusHub): self
    {
        $this->SusHub = $SusHub;

        return $this;
    }

    public function getTypePrixOrg(): ?string
    {
        return $this->TypePrixOrg;
    }

    public function setTypePrixOrg(?string $TypePrixOrg): self
    {
        $this->TypePrixOrg = $TypePrixOrg;

        return $this;
    }

    public function getPrixStpOrdTrg(): ?string
    {
        return $this->PrixStpOrdTrg;
    }

    public function setPrixStpOrdTrg(string $PrixStpOrdTrg): self
    {
        $this->PrixStpOrdTrg = $PrixStpOrdTrg;

        return $this;
    }

    public function getTradIdn(): ?string
    {
        return $this->TradIdn;
    }

    public function setTradIdn(?string $TradIdn): self
    {
        $this->TradIdn = $TradIdn;

        return $this;
    }

    public function getDestIdn(): ?string
    {
        return $this->DestIdn;
    }

    public function setDestIdn(?string $DestIdn): self
    {
        $this->DestIdn = $DestIdn;

        return $this;
    }

    public function getTypeCpt(): ?string
    {
        return $this->TypeCpt;
    }

    public function setTypeCpt(string $TypeCpt): self
    {
        $this->TypeCpt = $TypeCpt;

        return $this;
    }

    public function getNcptCl(): ?string
    {
        return $this->NcptCl;
    }

    public function setNcptCl(string $NcptCl): self
    {
        $this->NcptCl = $NcptCl;

        return $this;
    }

    public function getNtradOrd(): ?string
    {
        return $this->NtradOrd;
    }

    public function setNtradOrd(string $NtradOrd): self
    {
        $this->NtradOrd = $NtradOrd;

        return $this;
    }

    public function getDateHeureEntreeOrd(): ?\DateTimeInterface
    {
        return $this->DateHeureEntreeOrd;
    }

    public function setDateHeureEntreeOrd(\DateTimeInterface $DateHeureEntreeOrd): self
    {
        $this->DateHeureEntreeOrd = $DateHeureEntreeOrd;

        return $this;
    }

    public function getTxtLibr(): ?string
    {
        return $this->TxtLibr;
    }

    public function setTxtLibr(?string $TxtLibr): self
    {
        $this->TxtLibr = $TxtLibr;

        return $this;
    }

    public function getPostActionOrd(): ?string
    {
        return $this->PostActionOrd;
    }

    public function setPostActionOrd(?string $PostActionOrd): self
    {
        $this->PostActionOrd = $PostActionOrd;

        return $this;
    }

    public function getPostActionGvOrd(): ?string
    {
        return $this->PostActionGvOrd;
    }

    public function setPostActionGvOrd(?string $PostActionGvOrd): self
    {
        $this->PostActionGvOrd = $PostActionGvOrd;

        return $this;
    }

    public function getRefOrd(): ?string
    {
        return $this->RefOrd;
    }

    public function setRefOrd(string $RefOrd): self
    {
        $this->RefOrd = $RefOrd;

        return $this;
    }

    public function getTypePrixOrd(): ?OrdTypePrix
    {
        return $this->TypePrixOrd;
    }

    public function setTypePrixOrd(?OrdTypePrix $TypePrixOrd): self
    {
        $this->TypePrixOrd = $TypePrixOrd;

        return $this;
    }

    public function getTypeVldOrd(): ?OrdTypeVld
    {
        return $this->TypeVldOrd;
    }

    public function setTypeVldOrd(?OrdTypeVld $TypeVldOrd): self
    {
        $this->TypeVldOrd = $TypeVldOrd;

        return $this;
    }

    public function getStatOrd(): ?OrdStat
    {
        return $this->StatOrd;
    }

    public function setStatOrd(?OrdStat $StatOrd): self
    {
        $this->StatOrd = $StatOrd;

        return $this;
    }

    public function getDateFicher(): ?\DateTimeInterface
    {
        return $this->DateFicher;
    }

    public function setDateFicher(\DateTimeInterface $DateFicher): self
    {
        $this->DateFicher = $DateFicher;

        return $this;
    }
}
