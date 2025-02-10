<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Plat::class)]
    #[ORM\JoinColumn(name: "plat_id", referencedColumnName: "id", nullable: false)]
    private ?Plat $plat = null;

    #[ORM\ManyToOne(targetEntity: Ingredient::class)]
    #[ORM\JoinColumn(name: "ingredients_id", referencedColumnName: "id", nullable: false)] // Modifié en "ingredients_id"
    private ?Ingredient $ingredient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlat(): ?Plat
    {
        return $this->plat;
    }

    public function setPlat(?Plat $plat): static
    {
        $this->plat = $plat;

        return $this;
    }

    public function getIngredient(): ?Ingredient // Getter modifié pour correspondre au nom
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): static // Setter modifié pour correspondre au nom
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
