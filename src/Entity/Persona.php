<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Persona
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private string $nombre;

    #[ORM\Column(length: 50)]
    private string $apellido;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $fechaNac = null;

    #[ORM\ManyToOne(targetEntity: Sexo::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sexo $sexo = null;


    public function getId(): ?int { return $this->id; }
    
    public function getNombre(): string { return $this->nombre; }
    public function setNombre(string $nombre): self { $this->nombre = $nombre; return $this; }

    public function getApellido(): string { return $this->apellido; }
    public function setApellido(string $apellido): self { $this->apellido = $apellido; return $this; }

    public function getFechaNac(): ?\DateTimeInterface { return $this->fechaNac; }
    public function setFechaNac(?\DateTimeInterface $fechaNac): self { $this->fechaNac = $fechaNac; return $this; }

    public function getSexo(): ?Sexo { return $this->sexo; }
    public function setSexo(?Sexo $sexo): self { $this->sexo = $sexo; return $this; }
}
