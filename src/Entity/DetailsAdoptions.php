<?php

namespace App\Entity;

use App\Repository\DetailsAdoptionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailsAdoptionsRepository::class)]
class DetailsAdoptions
{

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'detailsAdoptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adoptions $adoptions = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'detailsAdoptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animaux $animaux = null;

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getAdoptions(): ?Adoptions
    {
        return $this->adoptions;
    }

    public function setAdoptions(?Adoptions $adoptions): self
    {
        $this->adoptions = $adoptions;

        return $this;
    }

    public function getAnimaux(): ?Animaux
    {
        return $this->animaux;
    }

    public function setAnimaux(?Animaux $animaux): self
    {
        $this->animaux = $animaux;

        return $this;
    }
}
