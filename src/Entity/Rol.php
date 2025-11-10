<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Rol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private string $descripcion;

    public function getId(): ?int { return $id; }
    public function getDescripcion(): string { return $this->descripcion; }
    public function setDescripcion(string $descripcion): self {
        $this->descripcion = $descripcion;
        return $this;
    }
}
