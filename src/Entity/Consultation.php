<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConsultationRepository::class)]
#[ORM\HasLifecycleCallbacks()]
class Consultation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'text', nullable: true)]
    private $observation;

    #[ORM\ManyToOne(targetEntity: Sick::class, inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private $sick;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'consultations')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updatedAt;

    #[ORM\Column(type: 'array', nullable: true)]
    private $anamneseInitialeParo = [];

    #[ORM\Column(type: 'array', nullable: true)]
    private $facteursGenerauxInitialeParo = [];

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $douleurGingivaleInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $hyperSensibiliteDentinaireInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $prescriptionDesensibilisantInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $mauvaiseHaleineSubjectiveInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $mobiliteDentaireSubjectiveInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $migrationDentaireSubjectiveInitialeParo;

    #[ORM\Column(type: 'string', length: 1, nullable: true)]
    private $indiceSaignementInitialeParo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $tabacInitialeParo;

    #[ORM\Column(type: 'array', nullable: true)]
    private $secteur1MobiliteCliniqueInitialeParo = [];

    #[ORM\Column(type: 'array', nullable: true)]
    private $secteur2MobiliteCliniqueInitialeParo = [];

    #[ORM\Column(type: 'array', nullable: true)]
    private $secteur3MobiliteCliniqueInitialeParo = [];

    #[ORM\Column(type: 'array', nullable: true)]
    private $secteur4MobiliteCliniqueInitialeParo = [];

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $nombreSiteSondesInitialeParo;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $nombrePointSaignementInitialeParo;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $nombrePoche3mmInitialeParo;

    #[ORM\Column(type: 'smallint', nullable: true)]
    private $nombrePoche5mmInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $dentsMajoritairementConservablesInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $evolutionInitialeParo;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $dentsPerduesParMPInitialeParo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getSick(): ?Sick
    {
        return $this->sick;
    }

    public function setSick(?Sick $sick): self
    {
        $this->sick = $sick;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PrePersist]

    public function createdDate()
    {
        $this->setCreatedAt(new \Datetime());
    }

    #[ORM\PreUpdate]

    public function updatedDate()
    {
        $this->setUpdatedAt(new \Datetime());
    }

    public function getAnamneseInitialeParo(): ?array
    {
        return $this->anamneseInitialeParo;
    }

    public function setAnamneseInitialeParo(?array $anamneseInitialeParo): self
    {
        $this->anamneseInitialeParo = $anamneseInitialeParo;

        return $this;
    }

    public function getFacteursGenerauxInitialeParo(): ?array
    {
        return $this->facteursGenerauxInitialeParo;
    }

    public function setFacteursGenerauxInitialeParo(?array $facteursGenerauxInitialeParo): self
    {
        $this->facteursGenerauxInitialeParo = $facteursGenerauxInitialeParo;

        return $this;
    }

    public function getDouleurGingivaleInitialeParo(): ?bool
    {
        return $this->douleurGingivaleInitialeParo;
    }

    public function setDouleurGingivaleInitialeParo(?bool $douleurGingivaleInitialeParo): self
    {
        $this->douleurGingivaleInitialeParo = $douleurGingivaleInitialeParo;

        return $this;
    }

    public function getHyperSensibiliteDentinaireInitialeParo(): ?bool
    {
        return $this->hyperSensibiliteDentinaireInitialeParo;
    }

    public function setHyperSensibiliteDentinaireInitialeParo(?bool $hyperSensibiliteDentinaireInitialeParo): self
    {
        $this->hyperSensibiliteDentinaireInitialeParo = $hyperSensibiliteDentinaireInitialeParo;

        return $this;
    }

    public function getPrescriptionDesensibilisantInitialeParo(): ?bool
    {
        return $this->prescriptionDesensibilisantInitialeParo;
    }

    public function setPrescriptionDesensibilisantInitialeParo(?bool $prescriptionDesensibilisantInitialeParo): self
    {
        $this->prescriptionDesensibilisantInitialeParo = $prescriptionDesensibilisantInitialeParo;

        return $this;
    }

    public function getMauvaiseHaleineSubjectiveInitialeParo(): ?bool
    {
        return $this->mauvaiseHaleineSubjectiveInitialeParo;
    }

    public function setMauvaiseHaleineSubjectiveInitialeParo(?bool $mauvaiseHaleineSubjectiveInitialeParo): self
    {
        $this->mauvaiseHaleineSubjectiveInitialeParo = $mauvaiseHaleineSubjectiveInitialeParo;

        return $this;
    }

    public function getMobiliteDentaireSubjectiveInitialeParo(): ?bool
    {
        return $this->mobiliteDentaireSubjectiveInitialeParo;
    }

    public function setMobiliteDentaireSubjectiveInitialeParo(?bool $mobiliteDentaireSubjectiveInitialeParo): self
    {
        $this->mobiliteDentaireSubjectiveInitialeParo = $mobiliteDentaireSubjectiveInitialeParo;

        return $this;
    }

    public function getMigrationDentaireSubjectiveInitialeParo(): ?bool
    {
        return $this->migrationDentaireSubjectiveInitialeParo;
    }

    public function setMigrationDentaireSubjectiveInitialeParo(?bool $migrationDentaireSubjectiveInitialeParo): self
    {
        $this->migrationDentaireSubjectiveInitialeParo = $migrationDentaireSubjectiveInitialeParo;

        return $this;
    }

    public function getIndiceSaignementInitialeParo(): ?string
    {
        return $this->indiceSaignementInitialeParo;
    }

    public function setIndiceSaignementInitialeParo(?string $indiceSaignementInitialeParo): self
    {
        $this->indiceSaignementInitialeParo = $indiceSaignementInitialeParo;

        return $this;
    }

    public function getTabacInitialeParo(): ?string
    {
        return $this->tabacInitialeParo;
    }

    public function setTabacInitialeParo(?string $tabacInitialeParo): self
    {
        $this->tabacInitialeParo = $tabacInitialeParo;

        return $this;
    }

    public function getSecteur1MobiliteCliniqueInitialeParo(): ?array
    {
        return $this->secteur1MobiliteCliniqueInitialeParo;
    }

    public function setSecteur1MobiliteCliniqueInitialeParo(?array $secteur1MobiliteCliniqueInitialeParo): self
    {
        $this->secteur1MobiliteCliniqueInitialeParo = $secteur1MobiliteCliniqueInitialeParo;

        return $this;
    }

    public function getSecteur2MobiliteCliniqueInitialeParo(): ?array
    {
        return $this->secteur2MobiliteCliniqueInitialeParo;
    }

    public function setSecteur2MobiliteCliniqueInitialeParo(?array $secteur2MobiliteCliniqueInitialeParo): self
    {
        $this->secteur2MobiliteCliniqueInitialeParo = $secteur2MobiliteCliniqueInitialeParo;

        return $this;
    }

    public function getSecteur3MobiliteCliniqueInitialeParo(): ?array
    {
        return $this->secteur3MobiliteCliniqueInitialeParo;
    }

    public function setSecteur3MobiliteCliniqueInitialeParo(?array $secteur3MobiliteCliniqueInitialeParo): self
    {
        $this->secteur3MobiliteCliniqueInitialeParo = $secteur3MobiliteCliniqueInitialeParo;

        return $this;
    }

    public function getSecteur4MobiliteCliniqueInitialeParo(): ?array
    {
        return $this->secteur4MobiliteCliniqueInitialeParo;
    }

    public function setSecteur4MobiliteCliniqueInitialeParo(?array $secteur4MobiliteCliniqueInitialeParo): self
    {
        $this->secteur4MobiliteCliniqueInitialeParo = $secteur4MobiliteCliniqueInitialeParo;

        return $this;
    }

    public function getNombreSiteSondesInitialeParo(): ?int
    {
        return $this->nombreSiteSondesInitialeParo;
    }

    public function setNombreSiteSondesInitialeParo(?int $nombreSiteSondesInitialeParo): self
    {
        $this->nombreSiteSondesInitialeParo = $nombreSiteSondesInitialeParo;

        return $this;
    }

    public function getNombrePointSaignementInitialeParo(): ?int
    {
        return $this->nombrePointSaignementInitialeParo;
    }

    public function setNombrePointSaignementInitialeParo(?int $nombrePointSaignementInitialeParo): self
    {
        $this->nombrePointSaignementInitialeParo = $nombrePointSaignementInitialeParo;

        return $this;
    }

    public function getNombrePoche3mmInitialeParo(): ?int
    {
        return $this->nombrePoche3mmInitialeParo;
    }

    public function setNombrePoche3mmInitialeParo(?int $nombrePoche3mmInitialeParo): self
    {
        $this->nombrePoche3mmInitialeParo = $nombrePoche3mmInitialeParo;

        return $this;
    }

    public function getNombrePoche5mmInitialeParo(): ?int
    {
        return $this->nombrePoche5mmInitialeParo;
    }

    public function setNombrePoche5mmInitialeParo(?int $nombrePoche5mmInitialeParo): self
    {
        $this->nombrePoche5mmInitialeParo = $nombrePoche5mmInitialeParo;

        return $this;
    }

    public function getDentsMajoritairementConservablesInitialeParo(): ?bool
    {
        return $this->dentsMajoritairementConservablesInitialeParo;
    }

    public function setDentsMajoritairementConservablesInitialeParo(?bool $dentsMajoritairementConservablesInitialeParo): self
    {
        $this->dentsMajoritairementConservablesInitialeParo = $dentsMajoritairementConservablesInitialeParo;

        return $this;
    }

    public function getEvolutionInitialeParo(): ?bool
    {
        return $this->evolutionInitialeParo;
    }

    public function setEvolutionInitialeParo(?bool $evolutionInitialeParo): self
    {
        $this->evolutionInitialeParo = $evolutionInitialeParo;

        return $this;
    }

    public function getDentsPerduesParMPInitialeParo(): ?bool
    {
        return $this->dentsPerduesParMPInitialeParo;
    }

    public function setDentsPerduesParMPInitialeParo(?bool $dentsPerduesParMPInitialeParo): self
    {
        $this->dentsPerduesParMPInitialeParo = $dentsPerduesParMPInitialeParo;

        return $this;
    }
}
