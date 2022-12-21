<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\AdoptionsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AdoptionsRepository::class)]
class Adoptions
{
    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    private ?string $reference;


    #[ORM\ManyToOne(inversedBy: 'adoptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    #[ORM\OneToMany(mappedBy: 'adoptions', targetEntity: DetailsAdoptions::class, orphanRemoval: true)]
    private Collection $detailsAdoptions;


    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->animaux = new ArrayCollection();
        $this->detailsAdoptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }


    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

   
    public function getAnimaux(): Collection
    {
        return $this->animaux;
    }

    /**
     * @return Collection<int, DetailsAdoptions>
     */
    public function getDetailsAdoptions(): Collection
    {
        return $this->detailsAdoptions;
    }

    public function addDetailsAdoption(DetailsAdoptions $detailsAdoption): self
    {
        if (!$this->detailsAdoptions->contains($detailsAdoption)) {
            $this->detailsAdoptions->add($detailsAdoption);
            $detailsAdoption->setAdoptions($this);
        }

        return $this;
    }

    public function removeDetailsAdoption(DetailsAdoptions $detailsAdoption): self
    {
        if ($this->detailsAdoptions->removeElement($detailsAdoption)) {
            // set the owning side to null (unless already changed)
            if ($detailsAdoption->getAdoptions() === $this) {
                $detailsAdoption->setAdoptions(null);
            }
        }

        return $this;
    }


}
