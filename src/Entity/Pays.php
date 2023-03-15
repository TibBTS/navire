<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table(name:'pays')]
#[Assert\Unique(fiefds:['indicatif'])]
#[ORM\Index(name: 'ind_indicatif' ,columns:['indicatif'])]
#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(name:'indicatif',length: 3)]
    #[Assert\Regex('/[A-Z]{3}/',message : 'indicatif a plus de 3')]
    private ?string $indicatif = null;

    #[ORM\OneToMany(mappedBy: 'idpays', targetEntity: Port::class)]
    private Collection $ports;

    public function __construct()
    {
        $this->ports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaysId(): ?int
    {
        return $this->PaysId;
    }

    public function setPaysId(int $PaysId): self
    {
        $this->PaysId = $PaysId;

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
     * @return Collection<int, Port>
     */
    public function getPorts(): Collection
    {
        return $this->ports;
    }

    public function addPort(Port $port): self
    {
        if (!$this->ports->contains($port)) {
            $this->ports->add($port);
            $port->setIdpays($this);
        }

        return $this;
    }

    public function removePort(Port $port): self
    {
        if ($this->ports->removeElement($port)) {
            // set the owning side to null (unless already changed)
            if ($port->getIdpays() === $this) {
                $port->setIdpays(null);
            }
        }

        return $this;
    }
}
