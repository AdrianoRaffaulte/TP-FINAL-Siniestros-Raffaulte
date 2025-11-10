<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Siniestro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $fecha;

    #[ORM\Column(type: 'time')]
    private \DateTimeInterface $hora;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $obs = null;

    #[ORM\ManyToOne(targetEntity: Clima::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private ?Clima $clima = null;

    public function getId(): ?int { return $this->id; }
    public function getFecha(): \DateTimeInterface { return $this->fecha; }
    public function setFecha(\DateTimeInterface $fecha): self { $this->fecha = $fecha; return $this; }

    public function getHora(): \DateTimeInterface { return $this->hora; }
    public function setHora(\DateTimeInterface $hora): self { $this->hora = $hora; return $this; }

    public function getObs(): ?string { return $this->obs; }
    public function setObs(?string $obs): self { $this->obs = $obs; return $this; }

    public function getClima(): ?Clima { return $this->clima; }
    public function setClima(?Clima $clima): self { $this->clima = $clima; return $this; }
}
