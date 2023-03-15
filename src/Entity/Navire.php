<?php

namespace App\Entity;

use App\Repository\NavireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[Assert\Unique(fields:['IMO','MMSI','Indicatif'])]
#[ORM\Entity(repositoryClass: NavireRepository::class)]
#[ORM\Index(name: 'ind_IMO' ,columns:['imo'])]
#[ORM\Index(name:'ind_MMSI' ,columns:['mmsi'])]
class Navire

{
      
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    
    #[ORM\ManyToOne(inversedBy:'navires')]
    #[ORM\joinColumn(name:'idaisshiptype',referencedColumnName:'id', nullable: false)]
    private ?AisShipType $aisShiptType = null;

     
    #[ORM\Column(name:'imo',length: 7)]
    #[Assert\Regex('[1-9][0-9]{6}',message : 'le num IMO unique et plus de 7 chiffre')]
    private ?string $IMO = null;

    #[ORM\Column(length: 255)]
    private ?string $NomNavire = null;

    #[ORM\Column(length: 9)]
    private ?string $MMSI = null;

    #[ORM\Column(length: 10)]
    private ?string $Indicatif = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Eta = null;

    #[ORM\Column]
    private ?int $longueur = null;

    #[ORM\Column]
    private ?int $largeur = null;

    #[ORM\Column]
    private ?float $tirantdeau = null;

    #[ORM\Column(length: 70)]
    private ?string $pavillon = null;

    #[ORM\ManyToOne(inversedBy: 'navires')]
    private ?Port $destination = null;

    #[ORM\OneToMany(mappedBy: 'idnavire', targetEntity: Escale::class)]
    private Collection $escales;

    public function __construct()
    {
        $this->escales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIMO(): ?string
    {
        return $this->IMO;
    }

    public function setIMO(string $IMO): self
    {
        $this->IMO = $IMO;

        return $this;
    }

    public function getNomNavire(): ?string
    {
        return $this->NomNavire;
    }

    public function setNomNavire(string $NomNavire): self
    {
        $this->NomNavire = $NomNavire;

        return $this;
    }

    public function getMMSI(): ?string
    {
        return $this->MMSI;
    }

    public function setMMSI(string $MMSI): self
    {
        $this->MMSI = $MMSI;

        return $this;
    }

    public function getIndicatif(): ?string
    {
        return $this->Indicatif;
    }

    public function setIndicatif(string $Indicatif): self
    {
        $this->Indicatif = $Indicatif;

        return $this;
    }

    public function getEta(): ?\DateTimeInterface
    {
        return $this->Eta;
    }

    public function setEta(?\DateTimeInterface $Eta): self
    {
        $this->Eta = $Eta;

        return $this;
    }

    public function getLongueur(): ?int
    {
        return $this->longueur;
    }

    public function setLongueur(int $longueur): self
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): self
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTirantdeau(): ?float
    {
        return $this->tirantdeau;
    }

    public function setTirantdeau(float $tirantdeau): self
    {
        $this->tirantdeau = $tirantdeau;

        return $this;
    }

    public function getPavillon(): ?string
    {
        return $this->pavillon;
    }

    public function setPavillon(string $pavillon): self
    {
        $this->pavillon = $pavillon;

        return $this;
    }

    public function getDestination(): ?Port
    {
        return $this->destination;
    }

    public function setDestination(?Port $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * @return Collection<int, Escale>
     */
    public function getEscales(): Collection
    {
        return $this->escales;
    }

    public function addEscale(Escale $escale): self
    {
        if (!$this->escales->contains($escale)) {
            $this->escales->add($escale);
            $escale->setIdnavire($this);
        }

        return $this;
    }

    public function removeEscale(Escale $escale): self
    {
        if ($this->escales->removeElement($escale)) {
            // set the owning side to null (unless already changed)
            if ($escale->getIdnavire() === $this) {
                $escale->setIdnavire(null);
            }
        }

        return $this;
    }
}
