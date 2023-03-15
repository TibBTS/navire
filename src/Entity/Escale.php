<?php

namespace App\Entity;

use App\Repository\EscaleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EscaleRepository::class)]
class Escale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateHeureArrive = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateHeureDepart = null;

    #[ORM\ManyToOne(inversedBy: 'escales')]
    private ?Navire $idnavire = null;

    #[ORM\ManyToOne(inversedBy: 'escales')]
    private ?Port $idport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureArrive(): ?\DateTimeInterface
    {
        return $this->dateHeureArrive;
    }

    public function setDateHeureArrive(\DateTimeInterface $dateHeureArrive): self
    {
        $this->dateHeureArrive = $dateHeureArrive;

        return $this;
    }

    public function getDateHeureDepart(): ?\DateTimeInterface
    {
        return $this->dateHeureDepart;
    }

    public function setDateHeureDepart(?\DateTimeInterface $dateHeureDepart): self
    {
        $this->dateHeureDepart = $dateHeureDepart;

        return $this;
    }

    public function getIdnavire(): ?Navire
    {
        return $this->idnavire;
    }

    public function setIdnavire(?Navire $idnavire): self
    {
        $this->idnavire = $idnavire;

        return $this;
    }

    public function getIdport(): ?Port
    {
        return $this->idport;
    }

    public function setIdport(?Port $idport): self
    {
        $this->idport = $idport;

        return $this;
    }
}
