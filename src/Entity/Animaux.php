<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\AnimauxRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AnimauxRepository::class)]
class Animaux
{
    use CreatedAtTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;


    #[ORM\ManyToOne(inversedBy: 'animaux')]
    #[ORM\JoinColumn(nullable: false)]
    private ?categories $categories = null;

    #[ORM\OneToMany(mappedBy: 'animaux', targetEntity: Images::class, orphanRemoval: true)]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'animaux', targetEntity: DetailsAdoptions::class)]
    private Collection $detailsAdoptions;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->detailsAdoptions = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

   

    public function getCategories(): ?categories
    {
        return $this->categories;
    }

    public function setCategories(?categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setAnimaux($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getAnimaux() === $this) {
                $image->setAnimaux(null);
            }
        }

        return $this;
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
            $detailsAdoption->setAnimaux($this);
        }

        return $this;
    }

    public function removeDetailsAdoption(DetailsAdoptions $detailsAdoption): self
    {
        if ($this->detailsAdoptions->removeElement($detailsAdoption)) {
            // set the owning side to null (unless already changed)
            if ($detailsAdoption->getAnimaux() === $this) {
                $detailsAdoption->setAnimaux(null);
            }
        }

        return $this;
    }

}
