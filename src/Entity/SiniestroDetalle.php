<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SiniestroDetalle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Siniestro::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Siniestro $siniestro;

    #[ORM\ManyToOne(targetEntity: Persona::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Persona $persona;

    #[ORM\ManyToOne(targetEntity: Rol::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private Rol $rol;

    public function getId(): ?int { return $this->id; }
    public function getSiniestro(): Siniestro { return $this->siniestro; }
    public function setSiniestro(Siniestro $s): self { $this->siniestro = $s; return $this; }

    public function getPersona(): Persona { return $this->persona; }
    public function setPersona(Persona $p): self { $this->persona = $p; return $this; }

    public function getRol(): Rol { return $this->rol; }
    public function setRol(Rol $r): self { $this->rol = $r; return $this; }
}
