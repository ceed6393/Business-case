<?php

namespace App\Entity;

use App\Repository\VetementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VetementRepository::class)]
class Vetement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

 

    #[ORM\OneToMany(mappedBy: 'vetement', targetEntity: Image::class, orphanRemoval: true)]
    private Collection $imageSecondaires;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $mainPicture = null;

    #[ORM\ManyToOne(inversedBy: 'vetements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    public function __construct()
    {
        $this->imageSecondaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }





    /**
     * @return Collection<int, Image>
     */
    public function getImageSecondaires(): Collection
    {
        return $this->imageSecondaires;
    }

    public function addImageSecondaire(Image $imageSecondaire): static
    {
        if (!$this->imageSecondaires->contains($imageSecondaire)) {
            $this->imageSecondaires->add($imageSecondaire);
            $imageSecondaire->setVetement($this);
        }

        return $this;
    }

    public function removeImageSecondaire(Image $imageSecondaire): static
    {
        if ($this->imageSecondaires->removeElement($imageSecondaire)) {
            // set the owning side to null (unless already changed)
            if ($imageSecondaire->getVetement() === $this) {
                $imageSecondaire->setVetement(null);
            }
        }

        return $this;
    }

    public function getMainPicture(): ?Image
    {
        return $this->mainPicture;
    }

    public function setMainPicture(?Image $mainPicture): static
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
