<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Index(name:'ind_INDICATIF', columns: ['indicatif'])]
#[Assert\Unique(fiefds:['indicatif'])]
#[ORM\Entity(repositoryClass: PortRepository::class)]
class Port
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name:'id')]
    private ?int $id = null;
    
    #[ORM\Column(name:'nom',length: 70)]
    private ?string $nom = null;

    #[ORM\Column(name:'indicatif',length: 5)]
    #[Assert\Regex('/[A-Z]{5}/',message : 'indicatif a plus de 5')]
    private ?string $indicatif = null;

    #[ORM\ManyToMany(targetEntity: AisShipType::class, inversedBy: 'idport')]
    private Collection $idaisshiptype;

    #[ORM\ManyToOne(inversedBy: 'ports')]
    private ?pays $idpays = null;

    #[ORM\OneToMany(mappedBy: 'destination', targetEntity: Navire::class)]
    private Collection $navires;

    #[ORM\OneToMany(mappedBy: 'idport', targetEntity: Escale::class)]
    private Collection $escales;

    public function __construct()
    {
        $this->idaisshiptype = new ArrayCollection();
        $this->navires = new ArrayCollection();
        $this->escales = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPort(): ?int
    {
        return $this->idPort;
    }

    public function setIdPort(int $idPort): self
    {
        $this->idPort = $idPort;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIndicatif(): ?string
    {
        return $this->indicatif;
    }

    public function setIndicatif(string $indicatif): self
    {
        $this->indicatif = $indicatif;

        return $this;
    }

    /**
     * @return Collection<int, AisShipType>
     */
    public function getIdaisshiptype(): Collection
    {
        return $this->idaisshiptype;
    }

    public function addIdaisshiptype(AisShipType $idaisshiptype): self
    {
        if (!$this->idaisshiptype->contains($idaisshiptype)) {
            $this->idaisshiptype->add($idaisshiptype);
        }

        return $this;
    }

    public function removeIdaisshiptype(AisShipType $idaisshiptype): self
    {
        $this->idaisshiptype->removeElement($idaisshiptype);

        return $this;
    }

    public function getIdpays(): ?pays
    {
        return $this->idpays;
    }

    public function setIdpays(?pays $idpays): self
    {
        $this->idpays = $idpays;

        return $this;
    }

    /**
     * @return Collection<int, Navire>
     */
    public function getNavires(): Collection
    {
        return $this->navires;
    }

    public function addNavire(Navire $navire): self
    {
        if (!$this->navires->contains($navire)) {
            $this->navires->add($navire);
            $navire->setDestination($this);
        }

        return $this;
    }

    public function removeNavire(Navire $navire): self
    {
        if ($this->navires->removeElement($navire)) {
            // set the owning side to null (unless already changed)
            if ($navire->getDestination() === $this) {
                $navire->setDestination(null);
            }
        }

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
            $escale->setIdport($this);
        }

        return $this;
    }

    public function removeEscale(Escale $escale): self
    {
        if ($this->escales->removeElement($escale)) {
            // set the owning side to null (unless already changed)
            if ($escale->getIdport() === $this) {
                $escale->setIdport(null);
            }
        }

        return $this;
    }

}
