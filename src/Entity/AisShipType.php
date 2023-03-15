<?php

namespace App\Entity;

use App\Repository\AisShipTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table (name :'aisshiptype')]
#[ORM\Entity(repositoryClass: AisShipTypeRepository::class)]
class AisShipType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name:'id')]
    private ?int $id = null;
    
    #[ORM\OneToMany(mappedBy: 'aisShiptType',targetEntity:Navire::class)]
    private Collection $navires;

    #[ORM\Column (name:"aisshiptype")]
    #[Assert\Range(
            min: 1,
            max: 9,
            notInRangeMessage: 'Le type AIS doit etre compris entre {{ min }} et {{max }}',
    )]
    private ?int $aisShipType = null;
       
    
    #[ORM\Column(name:'libelle',length: 60)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: Port::class, mappedBy: 'idaisshiptype')]
    private Collection $idport;

    public function __construct()
    {
        $this->idport = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAisShipType(): ?int
    {
        return $this->aisShipType;
    }

    public function setAisShipType(int $aisShipType): self
    {
        $this->aisShipType = $aisShipType;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Port>
     */
    public function getIdport(): Collection
    {
        return $this->idport;
    }

    public function addIdport(Port $idport): self
    {
        if (!$this->idport->contains($idport)) {
            $this->idport->add($idport);
            $idport->addIdaisshiptype($this);
        }

        return $this;
    }

    public function removeIdport(Port $idport): self
    {
        if ($this->idport->removeElement($idport)) {
            $idport->removeIdaisshiptype($this);
        }

        return $this;
    }
}
